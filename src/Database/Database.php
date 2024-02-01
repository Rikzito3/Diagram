<?php

namespace Ipeweb\Diagram\Database;

use PDO, PDOException;

class Database
{
    public $host = 'localhost';
    public $dbname = 'postgres';
    public $port = "5432";
    public $username = 'der';
    public $password = 'Alves2213';

    public function getConnection()
    {
        try {
            $dns = "pgsql:host={$this->host};port={$this->port};dbname={$this->dbname};user={$this->username};password={$this->password}";

            $pdo = new PDO($dns);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            return $pdo;
        } catch (PDOException $e) {
            die('Erro de conexão: ' . $e->getMessage());
        }
    }
}
