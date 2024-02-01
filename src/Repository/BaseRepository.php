<?php

namespace Ipeweb\Diagram\Repository;

use Ipeweb\Diagram\Database\Connection;
use PDO, PDOException;

class BaseRepository
{
    protected $connection;
    protected $table;

    public function __construct(Connection $connection, $table)
    {
        $this->connection = $connection;
        $this->table = $table;
    }

    public function getByForeignKey($foreignKey, $value)
    {
        $sql = "SELECT * FROM {$this->table} WHERE {$foreignKey} = :value";

        $stmt = $this->connection->getConnection()->prepare($sql);
        $stmt->execute(['value' => $value]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create(array $data)
    {
        $columns = implode(', ', array_keys($data));
        $values = ':' . implode(', :', array_keys($data));

        $sql = "INSERT INTO {$this->table} ({$columns}) VALUES ({$values})";

        $stmt = $this->connection->getConnection()->prepare($sql);
        $stmt->execute($data);
    }

    public function update(array $data, $id)
    {
        $set = '';
        foreach ($data as $key => $value) {
            $set .= "{$key} = :{$key}, ";
        }
        $set = rtrim($set, ', ');

        $sql = "UPDATE {$this->table} SET {$set} WHERE id = :id";
        $data['id'] = $id;

        $stmt = $this->connection->getConnection()->prepare($sql);
        $stmt->execute($data);
    }

    public function delete($id)
    {
        $sql = "DELETE FROM {$this->table} WHERE id = :id";

        $stmt = $this->connection->getConnection()->prepare($sql);
        $stmt->execute(['id' => $id]);
    }

    public function query($sql, $params = [])
    {
        $stmt = $this->connection->getConnection()->prepare($sql);
        $stmt->execute($params);
        return $stmt;
    }
}
