<?php


namespace HyperfTest\Cases;

use PDO;
use Reasno\HyperfMysqlPartition\MysqlConnection;
use Reasno\HyperfMysqlPartition\Schema\QueryBuilder;

class MySqlConnectionTest extends AbstractTestCase
{
    private $mysqlConnection;

    protected function setUp(): void
    {
        $mysqlConfig = ['driver' => 'mysql', 'prefix' => 'prefix', 'database' => 'database', 'name' => 'foo'];
        $this->mysqlConnection = new MysqlConnection(new PDOStub(), 'database', 'prefix', $mysqlConfig);
    }

    public function testGetQueryBuilder()
    {
        $builder = $this->mysqlConnection->query();

        $this->assertInstanceOf(QueryBuilder::class, $builder);
    }
}

class PDOStub extends PDO
{
    public function __construct()
    {
    }
}
