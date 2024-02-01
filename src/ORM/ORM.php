<?php

namespace Ipeweb\Diagram\ORM;

use PDO, PDOException;

class ORM
{
    public $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function findById($table, $id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM $table WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function findAll($table)
    {
        $stmt = $this->pdo->query("SELECT * FROM $table");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function insert($table, $data)
    {
        $columns = implode(', ', array_keys($data));
        $values = implode(', ', array_fill(0, count($data), '?'));
        $sql = "INSERT INTO $table ($columns) VALUES ($values)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(array_values($data));
        return $this->pdo->lastInsertId();
    }

    public function update($table, $data, $id)
    {
        $set = implode(' = ?, ', array_keys($data)) . ' = ?';
        $sql = "UPDATE $table SET $set WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        $values = array_values($data);
        $values[] = $id;
        $stmt->execute($values);
    }

    public function delete($table, $id)
    {
        $stmt = $this->pdo->prepare("DELETE FROM $table WHERE id = ?");
        $stmt->execute([$id]);
    }
}
