<?php

namespace Ivalex\Models\Tasks;

use Ivalex\Models\ActiveRecordEntity;
use Ivalex\Services\Db;


use Ivalex\Views\View;

/**
 * 
 */
interface GetStatus
{
    public function getStatus(): array;
}

/**
 * other properties will add automatically
 */
class Task extends ActiveRecordEntity implements GetStatus
{
    protected $id;
    private $name;
    private $email;
    private $text;
    private $status = [
        'complete' => 'Выполнено',
        'edited' => 'Отредактировано администратором',
    ];


    public function getName(): string
    {
        return $this->name;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getText(): string
    {
        return $this->text;
    }

    /**
     * 
     */
    public function getStatus(): array
    {
        $db = Db::getInstance();

        $taskStatus = $db->query('SELECT * FROM `task_status` WHERE task_id=:task_id;', [':task_id' => $this->id]);

        // dynamically add the Caption property
        // can use for lang constants
        foreach ($taskStatus as $statusObject) {
            $statusObject->caption = $this->status[$statusObject->status] ?? $statusObject->status;
        }

        return $taskStatus;
    }

    /**
     * contract
     */
    protected static function getTableName(): string
    {
        return 'tasks';
    }
}
