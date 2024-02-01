<?php

namespace Ipeweb\Diagram\Bootstrap;

use Ipeweb\Diagram\Database\Connection;
use Ipeweb\Diagram\Database\Database;

use PDO, PDOException;

class Request
{
    public static function init()
    {
        session_start();
    }

    public static function validateInput($input)
    {
        return !empty($input);
    }

    public static function redirectTo($location)
    {
        header("Location $location");
        exit();
    }

    public static function handle404()
    {
        header("HTTP/1.0 404 Not Found");
        echo 'Página não encontrada';
        exit();
    }

    public static function generateToken()
    {
        return bin2hex(random_bytes(32));
    }

    public static function verifyToken($token)
    {
        return isset($_SESSION['csrf_token']) && hash_equals($_SESSION['csrf_token'], $token);
    }

    public static function setCsrfToken()
    {
        $_SESSION['csrf_token'] = self::generateToken();
    }
    public static function sanitizeInput($input)
    {
        return htmlspecialchars($input, ENT_QUOTES, 'UTF-8');
    }

    public static function getCurrentUrl()
    {
        $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http';
        return $protocol . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    }

    public static function getClientIP()
    {
        return $_SERVER['REMOTE_ADDR'];
    }

    public static function isAjaxRequest()
    {
        return !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
    }

    public static function isRequestMethod($method)
    {
        return $_SERVER['REQUEST_METHOD'] === strtoupper($method);
    }

    public static function fetchDataFromTable()
    {
        $connection = new Connection();
        $pdo = $connection->getConnection();

        if ($pdo) {
            try {
                $psql = 'SELECT * FROM projects';
                $stmt = $pdo->query($psql);

                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            } catch (\PDOException $e) {
                throw new \Exception("Erro ao executar a consulta: " . $e->getMessage());
            }
        } else {
            throw new \Exception("Não foi possível estabelecer a conexão com o banco de dados.");
        }
    }
}
