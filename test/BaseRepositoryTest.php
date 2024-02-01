<?php

namespace Ipeweb\Diagram\Tests\Repository;

use PHPUnit\Framework\TestCase;
use Ipeweb\Diagram\Database\Connection;
use Ipeweb\Diagram\Repository\BaseRepository;
use PDO, PDOException;
use composer;

class BaseRepositoryTest extends TestCase
{
    protected $connection;
    protected $repository;

    protected function setUp(): void
    {
        $this->connection = new Connection();
        $this->repository = new BaseRepository($this->connection, 'test_table'); // Use uma tabela de teste
    }

    public function testCreate()
    {
        $data = [
            'column1' => 'value1',
            'column2' => 'value2',
        ];

        $this->repository->create($data);
        $createdRecord = $this->connection->getConnection()->query("SELECT * FROM test_table")->fetch(PDO::FETCH_ASSOC);
        $this->assertEquals($data, $createdRecord);
    }

    public function testGetByForeignKey()
    {
        $foreignKey = 'column1';
        $value = 'value1';
        $result = $this->repository->getByForeignKey($foreignKey, $value);

        $this->assertIsArray($result);
    }

    public function testUpdate()
    {
        $id = 1;
        $data = [
            'column1' => 'updated_value1',
            'column2' => 'updated_value2',
        ];

        $this->repository->update($data, $id);

        $updatedRecord = $this->connection->getConnection()->query("SELECT * FROM test_table WHERE id = $id")->fetch(PDO::FETCH_ASSOC);

        $this->assertEquals($data, $updatedRecord);
    }

    public function testDelete()
    {
        $id = 1;

        $this->repository->delete($id);

        $deletedRecord = $this->connection->getConnection()->query("SELECT * FROM test_table WHERE id = $id")->fetch(PDO::FETCH_ASSOC);

        $this->assertFalse($deletedRecord);
    }
}
