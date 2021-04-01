<?php

namespace Ivalex\Models;

use Ivalex\Services\Db;

/**
 * base class for table objects with convertion dynamic properties names
 */
abstract class ActiveRecordEntity
{
    // table record id
    protected $id;

    // dynamic object property addition
    public function __set($property, $value)
    {
        $propertyName = self::underscoreToCamelCase($property);
        $this->$propertyName = $value;
    }

    /**
     * @return int record id (autoincremental index field)
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * contract for each entity
     * @return string tableName
     */
    abstract protected static function getTableName(): string;

    public static function getRecordCount(): int
    {
        $sql = 'SELECT COUNT(`id`) AS `cRecords` FROM `' . static::getTableName() . '`;';

        $db = Db::getInstance();
        $result = $db->query($sql);

        return $result[0]->cRecords;
    }

    /**
     * can be used for multiple records
     * @param int $id - record id
     * @param string $compareOperator - "=", ">", "<=" etc.
     */
    public static function getById(int $id, string $compareOperator = '='): array
    {
        $sql = 'SELECT * FROM `' . static::getTableName() . '` WHERE `id`' . $compareOperator . ':id;';
        $params = [':id' => $id];

        $db = Db::getInstance();
        return $db->query($sql, $params, static::class);
    }

    /**
     * SELECT *
     *   FROM _table_name_
     *   ORDER BY $orderColumn $descOrder[ASC|DESC]
     *   LIMIT $offset, $countFetch
     */
    public static function getRowsGroup(int $offset, int $countFetch, string $orderColumn = 'id', bool $descOrder = false): array
    {
        $sql = 'SELECT * FROM `' . static::getTableName() . '` ' .
            'ORDER BY `' . $orderColumn . '` ' . ($descOrder ? 'DESC ' : 'ASC ') .
            'LIMIT ' . $offset . ', ' . $countFetch . ';';

        $db = Db::getInstance();
        return $db->query($sql, [], static::class);
    }

    public static function findOneByColumn(string $columnName, $value): ?self
    {
        $sql = 'SELECT * FROM `' . static::getTableName() . '` WHERE `' . $columnName . '` = :value LIMIT 1;';
        $params = [':value' => $value];

        $db = Db::getInstance();
        $result = $db->query($sql, $params, static::class);
        if ($result === []) {
            return null;
        }
        return $result[0];
    }

    public function save()
    {
        if ($this->id !== null) {
            $tableParams = $this->propertiesToTableParams(false);
            $this->update($tableParams);
        } else {
            $tableParams = $this->propertiesToTableParams();
            $this->insert($tableParams);
        }
    }

    private function update(array $tableParams): void
    {
        // remove `id` field from the update list
        unset($tableParams['sqlColumnsParams']['id']);

        $sql = 'UPDATE `' . static::getTableName() . '`' .
            ' SET ' . implode(', ', $tableParams['sqlColumnsParams']) .
            ' WHERE `id`=:id';

        $db = Db::getInstance();
        $db->query($sql, $tableParams['paramsValues']);
    }

    private function insert(array $tableParams): void
    {

        $sql = 'INSERT INTO `' . static::getTableName() . '` ' .
            '(' . implode(', ', $tableParams['columns']) . ') ' .
            'VALUES (' . implode(', ', $tableParams['params']) . ')';

        $db = Db::getInstance();
        $db->query($sql, $tableParams['paramsValues']);
        $this->id = $db->getLastInsertId();
    }

    public function delete(): void
    {
        $sql = 'DELETE FROM `' . static::getTableName() . '` WHERE `id` = :id';
        $params = [':id' => $this->id];

        $db = Db::getInstance();
        $db->query($sql, $params);
        $this->id = null;
    }

    /**
     * 
     */
    private function propertiesToTableParams(bool $excludeId = true): array
    {

        $reflector = new \ReflectionObject($this);
        $properties = $reflector->getProperties();

        $tableParams = [
            'columns' => [],
            'params' => [],
            'sqlColumnsParams' => [],
            'paramsValues' => [],
        ];

        foreach ($properties as $property) {
            $propertyName = $property->getName();
            $columnName = self::camelCaseToUnderscore($propertyName); // lowercase
            if (!($excludeId && ($columnName == 'id'))) {
                $paramName = ':' . $columnName;
                $value = $this->$propertyName;
                $tableParams['columns'][$columnName] = '`' . $columnName . '`';
                $tableParams['params'][$columnName] = $paramName;
                $tableParams['sqlColumnsParams'][$columnName] = '`' . $columnName . '`' . '=' . $paramName;
                $tableParams['paramsValues'][$paramName] = $value;
            }
        }

        return $tableParams;
    }

    private static function underscoreToCamelCase(string $underscoredString): string
    {
        return lcfirst(str_replace('_', '', ucwords($underscoredString, '_')));
    }

    private static function camelCaseToUnderscore(string $camelCaseString): string
    {
        return strtolower(preg_replace('~(?<!^)[A-Z]~', '_$0', $camelCaseString));
    }

    /**
     * For use in the SQL construction ...WHERE <$field> IN (<$values>)...
     * Convets the array $values to SQL blocks '[OR] (<$field> < =|like > :$field<1..N>)'
     * and array of params [':field<1..N>'=><$values>]
     * @param string $field
     * @param array $values
     * @param string $operator comparison operator such as '=' or 'like'
     * @return array ['sql' => (string) SQL_query_blocks, 'params' => (array) [SQL_params_values]]
     */
    protected static function arrayPreparedStatements(string $field, array $values, string $operator = '='): array
    {
        $params = array();
        if (empty($values)) {
            $sql = '`id` IN (:nullparam)';
            $params[':nullparam'] = 'NULL';
        } else {
            $sqlBlocks = array();
            foreach ($values as $key => $value) {
                $sqlBlocks[] = '(`' . $field . '`' . $operator . ':field' . $key . ')';
                $params[':field' . $key] = $value;
            }
            $sql = implode(' OR ', $sqlBlocks);
        }

        return ['sql' => $sql, 'params' => $params];
    }
}
