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
    protected $name;
    protected $email;
    protected $text;
    protected $status;

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name)
    {
        $this->name = $name;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email)
    {
        $this->email = $email;
    }

    public function getText(): string
    {
        return $this->text;
    }

    public function setText(string $text)
    {
        $this->text = $text;
    }

    /**
     * 
     */
    public function getStatus(): array
    {
        $db = Db::getInstance();
        $taskStatus = $db->query(
            'SELECT * FROM `task_status` WHERE (`binary_id` & :task_status);',
            [':task_status' => $this->status]
        );

        return $taskStatus;
    }

    public function setStatus(int $status)
    {
        $this->status = $status;
    }

    /**
     * contract
     */
    protected static function getTableName(): string
    {
        return 'tasks';
    }
}
