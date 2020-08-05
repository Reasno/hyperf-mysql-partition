<?php


namespace Reasno\HyperfMysqlPartition;


use Hyperf\Database\Query\Builder;
use Hyperf\Database\Query\Grammars\Grammar;
use Reasno\HyperfMysqlPartition\Schema\QueryBuilder;
use Reasno\HyperfMysqlPartition\Schema\MySqlGrammar;

class MysqlConnection extends \Hyperf\Database\MySqlConnection
{
    /**
     * Get a new query builder instance.
     */
    public function query() : Builder
    {
        return new QueryBuilder(
            $this,
            $this->getQueryGrammar(),
            $this->getPostProcessor()
        );
    }

    /**
     * Get the default query grammar instance.
     */
    protected function getDefaultQueryGrammar(): Grammar
    {
        return $this->withTablePrefix(new MySqlGrammar);
    }
}
