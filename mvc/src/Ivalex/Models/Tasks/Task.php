<?php

namespace Ivalex\Models\Tasks;

use Ivalex\Models\ActiveRecordEntity;
use Ivalex\Services\Db;
use Ivalex\Exceptions\BadValueException;


use Ivalex\Views\View;

/**
 * other properties will add automatically
 */
class Task extends ActiveRecordEntity
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
    public function getStatus(bool $allRecords = false): array
    {
        if ($allRecords) {
            $sql = 'SELECT `a`.*, `b`.`checked` FROM `task_status` AS `a` LEFT OUTER JOIN' .
                '(SELECT `id`, 1 AS `checked` FROM `task_status` WHERE (`binary_id` & :task_status)) AS `b`' .
                'ON `a`.`id`=`b`.`id`;';
        } else {
            $sql = 'SELECT * FROM `task_status` WHERE (`binary_id` & :task_status);';
        }

        $db = Db::getInstance();
        return $db->query($sql, [':task_status' => $this->status]);
    }

    public function setStatus(int $status)
    {
        $this->status = $status;
    }

    /**
     * 
     */
    public static function createTask(array $taskData): Task
    {
        if (empty($taskData['username'])) {
            throw new BadValueException('Не передано имя пользоателя');
        }
        if (empty($taskData['email'])) {
            throw new BadValueException('Не передан адрес электронной почты');
        }
        if (empty($taskData['text'])) {
            throw new BadValueException('Не передан текст задачи');
        }

        $task = new Task();

        $task->setName($taskData['username']);
        $task->setEmail($taskData['email']);
        $task->setText($taskData['text']);
        $task->setStatus(0);

        $task->save();

        return $task;
    }

    /**
     * 
     */
    public function updateTask(array $taskData): Task
    {
        if (empty($taskData['text'])) {
            throw new BadValueException('Не передан текст задачи');
        }

        $edited = ($this->getText() != $taskData['text']);
        $status = 0;

View::echoIt($taskData);
exit;
        $this->setText($taskData['text']);
        $this->setStatus($status);

        $this->save();

        return $this;
    }
    /**
     * contract
     */
    protected static function getTableName(): string
    {
        return 'tasks';
    }
}
