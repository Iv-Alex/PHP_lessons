<?php

namespace Ivalex\Controllers;

use Ivalex\Services\Db;
use Ivalex\Views\View;

class TasksController
{
    private $view;
    private $db;

    public function __construct()
    {
        $this->view = new View('default');
        $this->db = new Db();
    }

    public function view($taskId)
    {
        $result = $this->db->query(
            'SELECT * FROM `tasks` WHERE task_id=:id;',
            [':id' => $taskId]
        );

        // if task not found
        if ($result === []) {
            // create an error page and set the HTTP status code to 404
            $this->view->renderHtml('err404.php', [], 404);
            return;
        }

        $this->view->renderHtml('task.php', ['task' => $result[0]]);
    }
}
