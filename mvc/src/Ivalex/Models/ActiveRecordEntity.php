<?php

namespace Ivalex\Models;

use Ivalex\Services\Db;

/**
 * base class for table objects with convertion dynamic properties names
 */
abstract class ActiveRecordEntity
{

    public function __set($property, $value)
    {
        $propertyName = $this->underscoreToCamelCase($property);
        $this->$propertyName = $value;
    }

    private function underscoreToCamelCase(string $underscoredString): string
    {
        return lcfirst(str_replace('_', '', ucwords($underscoredString, '_')));
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
        $db = new Db();
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

        $db = new Db();

        $recordById = $db->query(
            'SELECT * FROM `' . static::getTableName() . '` WHERE id=:id;',
            [':id' => $id],
            static::class
        );
        return $recordById ? $recordById[0] : null;
    }

    public function getId(): int
    {
        return $this->id;
    }


}
