<?php

namespace Ivalex\Controllers;

use Ivalex\Models\Tasks\Task;
use Ivalex\Exceptions\NotFoundException;

class TasksController extends BasicController
{
    public function view(int $taskId): void
    {
        $task = Task::getById($taskId);

        // if task not found
        if ($task === null) {
            throw new NotFoundException();
        }

        $this->view->renderHtml('task.php', ['task' => $task]);
    }

    public function edit($taskId): void
    {
        $task = Task::getById($taskId);

        if ($task === null) {
            throw new NotFoundException();
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
        $this->view->setVar('header', 'Создание задачи');
        $this->view->renderHtml('editTask.php', ['task' => $task]);
        //        $task->save();
    }
}
