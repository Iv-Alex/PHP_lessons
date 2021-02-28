<?php

namespace Ivalex\Models;

use Ivalex\Services\Db;

use Ivalex\Views\View;

/**
 * base class for table objects with convertion dynamic properties names
 */
abstract class ActiveRecordEntity
{
    protected $id;

    public function __set($property, $value)
    {
        $propertyName = self::underscoreToCamelCase($property);
        $this->$propertyName = $value;
    }

    /**
     * 
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * contract
     * @return string tableName
     */
    abstract protected static function getTableName(): string;

    /**
     * 
     */
    public static function getAllRecords(): array
    {
        $db = Db::getInstance();
        return $db->query(
            'SELECT * FROM `' . static::getTableName() . '`;',
            [],
            static::class
        );
    }

    /**
     * can be used for multiple records if 'id' is not unique
     */
    public static function getById(int $id): ?self
    {

        $db = Db::getInstance();

        $recordById = $db->query(
            'SELECT * FROM `' . static::getTableName() . '` WHERE id=:id;',
            [':id' => $id],
            static::class
        );
        return $recordById ? $recordById[0] : null;
    }

    public function save()
    {
        $tableParams = $this->propertiesToTableParams();
        if ($this->id !== null) {
            $this->update($tableParams);
        } else {
            $this->insert($tableParams);
        }
    }

    private function update(array $tableParams): void
    {
        $db = Db::getInstance();

        $sql = 'UPDATE `' . static::getTableName() . '`' .
            ' SET ' . implode(', ', $tableParams['sqlColumnsParams']) .
            ' WHERE id=:id';

        // TODO edited by admin

        $db->query($sql, $tableParams['paramsValues']);
    }

    private function insert(array $tableParams): void
    {
        $db = Db::getInstance();

        $sql = 'INSERT INTO `' . static::getTableName() . '` ' .
            '(' . implode(', ', $tableParams['columns']) . ') ' .
            'VALUES (' . implode(', ', $tableParams['params']) . ')';

        $db->query($sql, $tableParams['paramsValues']);
    }

    /**
     * 
     */
    private function propertiesToTableParams(): array
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
            $paramName = ':' . $columnName;
            $value = $this->$propertyName;
            $tableParams['columns'][] = '`' . $columnName . '`';
            $tableParams['params'][] = $paramName;
            $tableParams['sqlColumnsParams'][] = $columnName . '=' . $paramName;
            $tableParams['paramsValues'][$paramName] = $value;
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
}
