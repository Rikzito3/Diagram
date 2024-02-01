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

        // Verifica se o registro foi criado no banco de dados
        $createdRecord = $this->connection->getConnection()->query("SELECT * FROM test_table")->fetch(PDO::FETCH_ASSOC);

        // Verifica se os dados criados correspondem aos dados de teste
        $this->assertEquals($data, $createdRecord);
    }

    public function testGetByForeignKey()
    {
        // Dados de teste
        $foreignKey = 'column1';
        $value = 'value1';

        // Chama o método getByForeignKey
        $result = $this->repository->getByForeignKey($foreignKey, $value);

        // Verifica se o resultado é um array
        $this->assertIsArray($result);

        // Verifica se os dados retornados correspondem aos esperados
        // Isso depende do ambiente e dos dados de teste disponíveis
    }

    public function testUpdate()
    {
        // Dados de teste
        $id = 1; // ID do registro a ser atualizado
        $data = [
            'column1' => 'updated_value1',
            'column2' => 'updated_value2',
        ];

        // Chama o método update
        $this->repository->update($data, $id);

        // Verifica se os dados foram atualizados no banco de dados
        $updatedRecord = $this->connection->getConnection()->query("SELECT * FROM test_table WHERE id = $id")->fetch(PDO::FETCH_ASSOC);

        // Verifica se os dados atualizados correspondem aos dados de teste
        $this->assertEquals($data, $updatedRecord);
    }

    public function testDelete()
    {
        // ID do registro a ser deletado
        $id = 1;

        // Chama o método delete
        $this->repository->delete($id);

        // Verifica se o registro foi removido do banco de dados
        $deletedRecord = $this->connection->getConnection()->query("SELECT * FROM test_table WHERE id = $id")->fetch(PDO::FETCH_ASSOC);

        // Verifica se o registro não existe mais no banco de dados
        $this->assertFalse($deletedRecord);
    }
}
