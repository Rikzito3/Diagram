<?php

namespace Ipeweb\Diagram\Database;

use Ipeweb\Diagram\Database\Database;
use PDO, PDOException;

class Connection extends Database
{
    private $pdo;

    public function connection($host, $port, $dbname, $username, $password)
    {
        try {
            $dsn = "pgsql:host={$host};port={$port};dbname={$dbname};user={$username};password={$password}";

            echo "Tentando se conectar ao banco de dados com DSN: $dsn<br>";

            $this->pdo = new PDO($dsn);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            echo "Conexão estabelecida com sucesso!<br>";

            return $this->pdo;
        } catch (PDOException $e) {
            die('Erro de Conexão: ' . $e->getMessage());
        }
    }

    public function query($sql, $params = [])
    {
        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute($params);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die('Erro ao executar a consulta: ' . $e->getMessage());
        }
    }

    public function getConnection()
    {
        return $this->pdo;
    }
}
