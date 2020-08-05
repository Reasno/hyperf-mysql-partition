<?php


namespace Reasno\HyperfMysqlPartition\Model;

use Hyperf\Database\Model\Model;
use Hyperf\Database\Query\Builder;

class MultipleSchemaModel extends Model{

    /**
     * DB name to override inside a query
     *
     * @var string
     */
    private $databaseName = null;

    /**
     * Save the model to the database.
     *
     * @param $name
     * @param $options
     * @return bool
     */
    public function saveOnDb($name, $options = [])
    {
        $this->databaseName = $name;
        return self::save($options);
    }

    /**
     * Get a new query builder that doesn't have any global scopes or eager loading.
     *
     * @return Builder|static
     */
    public function newModelQuery()
    {
        $queryBuilder = $this->newEloquentBuilder(
            $this->newBaseQueryBuilder()
        )->setModel($this);
        if ($this->databaseName !== null){
            $queryBuilder->db($this->databaseName);
        }
        return $queryBuilder;
    }

}
