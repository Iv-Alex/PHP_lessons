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

    public function view(int $taskId): void
    {
        $task = Task::getById($taskId);

        // if task not found
        if ($task === null) {
            // create an error page and set the HTTP status code to 404
            $this->view->renderHtml('err404.php', [], 404);
            return;
        }

        $this->view->renderHtml('task.php', ['task' => $task]);
    }

    public function edit($taskId): void
    {
        $task = Task::getById($taskId);

        if ($task === null) {
            // create an error page and set the HTTP status code to 404
            $this->view->renderHtml('err404.php', [], 404);
            return;
        }

        $task->setName('Mikhail');
        $task->setText('Lorem ipsum dolor sit amet consectetur, adipisicing elit.
        Asperiores, debitis? Illum ullam eligendi exercitationem! Sunt esse reiciendis,
        minus nemo sed totam in laboriosam. Ducimus, saepe. Ipsum vel aliquam sint quia!
        FOOBAR');

        $task->save();
    }

    public function add(): void
    {
        $task = new Task();
        $task->setName('Mikhail');
        $task->setEmail('Mikhail@test.ru');
        $task->setText('Lorem ipsum dolor sit amet consectetur, adipisicing elit.
        Asperiores, debitis? Illum ullam eligendi exercitationem! Sunt esse reiciendis,
        minus nemo sed totam in laboriosam. Ducimus, saepe. Ipsum vel aliquam sint quia!
        FOOBAR');

        $task->save();
    }
}
