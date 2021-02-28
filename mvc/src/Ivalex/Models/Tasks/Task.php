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
        $statusCaptions = (require __DIR__ . '/../../../captions.php')['taskStatus'];
        $db = Db::getInstance();

        $taskStatus = $db->query('SELECT * FROM `task_status` WHERE task_id=:task_id;', [':task_id' => $this->id]);

        // dynamically add the Caption property
        // can use for lang constants
        foreach ($taskStatus as $statusObject) {
            $statusObject->caption = $statusCaptions[$statusObject->status] ?? $statusObject->status;
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
