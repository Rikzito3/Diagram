<?php

namespace Ipeweb\Diagram\Database;

use PDO;
use PDOException;
use Ipeweb\Diagram\ORM\ORM;

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

            $orm = new ORM($pdo);

            return (object)['pdo' => $pdo, 'orm' => $orm];
        } catch (PDOException $e) {
            die('Erro de conexão: ' . $e->getMessage());
        }
    }
}
