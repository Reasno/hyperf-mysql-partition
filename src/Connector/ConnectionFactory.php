<?php


namespace Reasno\HyperfMysqlPartition\Connector;

use Hyperf\Database\ConnectionInterface;
use Reasno\HyperfMysqlPartition\MysqlConnection;
use \PDO;

class ConnectionFactory extends \Hyperf\Database\Connectors\ConnectionFactory
{
    /**
     * @param string       $driver
     * @param \Closure|PDO $connection
     * @param string       $database
     * @param string       $prefix
     * @param array        $config
     *
     * @return ConnectionInterface
     */
    protected function createConnection($driver, $connection, $database, $prefix = '', array $config = [])
    {
        if ($driver === 'mysql') {
            return new MysqlConnection($connection, $database, $prefix, $config);
        }

        return parent::createConnection($driver, $connection, $database, $prefix, $config);
    }
}
