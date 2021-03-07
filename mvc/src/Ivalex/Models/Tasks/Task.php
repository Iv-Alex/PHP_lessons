<?php

namespace Ivalex\Models\Tasks;

use Ivalex\Models\ActiveRecordEntity;
use Ivalex\Services\Db;
use Ivalex\Exceptions\BadValueException;

/**
 * other properties will add automatically
 */
class Task extends ActiveRecordEntity
{
    protected $name;
    protected $email;
    protected $text;
    protected $status;

    /**
     * All functions get<StringField>() returns htmlspecialchars(<value>).
     * Use or create if missing get<StringField>Directly() for get the original values
     * @return string user name
     */
    public function getName(): string
    {
        return htmlspecialchars($this->name);
    }

    public function setName(string $name)
    {
        $this->name = $name;
    }

    /**
     * All functions get<StringField>() returns htmlspecialchars(<value>).
     * Use or create if missing get<StringField>Directly() for get the original values
     * @return string email
     */
    public function getEmail(): string
    {
        return htmlspecialchars($this->email);
    }

    public function setEmail(string $email)
    {
        $this->email = $email;
    }

    /**
     * All functions get<StringField>() returns htmlspecialchars(<value>).
     * Use or create if missing get<StringField>Directly() for get the original values
     * @return string task text
     */
    public function getText(): string
    {
        return htmlspecialchars($this->text);
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

    public function setStatus(array $status = [], bool $edited = false)
    {
        $preparedStatements = self::arrayPreparedStatements('id', $status);

        $sql = 'SELECT SUM(`binary_id`) AS `summary` FROM `task_status` WHERE ' . $preparedStatements['sql'];
        $sql .= $edited ? ' OR (`setting` LIKE "on_edit");' : ';';

        $db = Db::getInstance();
        $result = $db->query($sql, $preparedStatements['params']);

        $this->status = empty($result[0]) ? 0 : intval($result[0]->summary);
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
        $task->setStatus();

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

        $this->setText($taskData['text']);
        $this->setStatus($taskData['status'] ?? [], $edited);

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
