<?php

namespace Ipeweb\Diagram\Resources\BaseResource;

use Ipeweb\Diagram\Database\Database;
use PDO;
use PDOException;

class BaseResource
{
    protected $conn;
    protected $table;

    public function __construct($table)
    {
        $db = new Database();
        $this->conn = $db->getConnection();
        $this->table = $table;
    }

    public function listItems()
    {
        if (!$this->conn || !$this->conn instanceof PDO) {
            return ['error' => 'Internal Server Error', 'message' => 'Database connection not established'];
        }


        try {
            $sql = "SELECT * FROM {$this->table}";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();

            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if ($result) {
                return print json_encode($result);
            } else {
                return ['message' => "No {$this->table} found"];
            }
        } catch (PDOException $e) {
            return ['error' => 'Internal Server Error', 'message' => $e->getMessage()];
        }
    }


    public function createItem($itemData)
    {
        try {
            $columns = implode(", ", array_keys($itemData));
            $values = ":" . implode(", :", array_keys($itemData));

            $sql = "INSERT INTO {$this->table} ({$columns}) VALUES ({$values})";
            $stmt = $this->conn->prepare($sql);

            foreach ($itemData as $key => $value) {
                $stmt->bindValue(":{$key}", $value);
            }

            $stmt->execute();

            return ['message' => "{$this->table} created successfully"];
        } catch (PDOException $e) {
            throw new \Exception('Failed to create item.', 500, $e);
        }
    }

    public function updateItem($itemId, $itemData)
    {
        try {
            $setClause = implode(", ", array_map(function ($key) {
                return "{$key} = :{$key}";
            }, array_keys($itemData)));

            $sql = "UPDATE {$this->table} SET {$setClause} WHERE id = :itemId";
            $stmt = $this->conn->prepare($sql);

            foreach ($itemData as $key => $value) {
                $stmt->bindValue(":{$key}", $value);
            }

            $stmt->bindParam(':itemId', $itemId);
            $stmt->execute();

            return ['message' => "{$this->table} updated successfully"];
        } catch (PDOException $e) {
            throw new \Exception('Failed to update item.', 500, $e);
        }
    }

    public function desactivateItem($itemId)
    {
        try {
            $sql = "UPDATE {$this->table} SET ativo = false WHERE id = :itemId";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':itemId', $itemId);
            $stmt->execute();

            return ['message' => "{$this->table} desactivated successfully"];
        } catch (PDOException $e) {
            throw new \Exception('Failed to deactivate item.', 500, $e);
        }
    }
}
