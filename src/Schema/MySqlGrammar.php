<?php


namespace Reasno\HyperfMysqlPartition\Schema;


use Hyperf\Database\Query\Builder;

class MySqlGrammar extends \Hyperf\Database\Query\Grammars\MySqlGrammar
{

    /**
     * Compile an insert statement into SQL.
     *
     * @param  Builder  $query
     * @param  array  $values
     * @return string
     */
    public function compileInsert(Builder $query, array $values)
    {
        return str_replace('insert into ', 'insert into '.$this->compileDbName($query, $values), parent::compileInsert($query, $values));
    }

    /**
     * Compile the "from" portion of the query.
     *
     * @param  Builder  $query
     * @param  string  $table
     * @return string
     */
    protected function compileFrom(Builder $query, $table)
    {
        $baseFrom = 'from'.$this->compileDbName($query, $table).$this->wrapTable($table);
        if ($query->hasPartitions()){
            return $baseFrom . $this->compilePartitions($query);
        }
        return $baseFrom;
    }

    /**
     * Get database name if isset
     *
     * @param Builder $query
     * @param $table
     * @return string
     */
    private function compileDbName(Builder $query, $table)
    {
        if ($query instanceof QueryBuilder){
            return $query->getDb() !== null ? ($this->wrap($query->getDb()).'.') : '';
        }
        return '';
    }

    /**
     * Compile the "partition" portion of the query.
     *
     * @param  Builder  $query
     * @return string
     */
    protected function compilePartitions(Builder $query){
        return ' PARTITION ('.collect($query->getPartitions())->map(static function($partition){
                return "`{$partition}`";
            })->join(', ').')';
    }

}
