<?php

namespace Ivalex\Controllers;

use Ivalex\Views\View;
use Ivalex\Models\Tasks\Task;

class TasksController
{
    private $view;

    public function __construct()
    {
        $this->view = new View('default');
    }

    public function view(int $taskId)
    {
        $task = Task::getById($taskId);

        // if task not found
        if ($task === null) {
            // create an error page and set the HTTP status code to 404
            $this->view->renderHtml('err404.php', [], 404);
            return;
        }

        // get task status
        $taskStatus = $task->getStatus();
        $this->view->renderHtml(
            'task.php',
            [
                'task' => $task,
                'taskStatus' => $taskStatus,
            ]
        );
    }

    public function new()
    {
        $this->view->renderHtml('newTask.php');
    }
}
