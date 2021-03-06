<?php

namespace Ivalex\Controllers;

use Ivalex\Models\Tasks\Task;
use Ivalex\Exceptions\NotFoundException;
use Ivalex\Exceptions\UnauthorizedException;
use Ivalex\Exceptions\BadValueException;
use Ivalex\Exceptions\ForbiddenException;
use Ivalex\Views\View;

class TasksController extends BasicController
{
    public function view(int $taskId, int $messageId = null): void
    {

        $task = Task::getById($taskId);

        // if task not found
        if ($task === null) {
            throw new NotFoundException();
        }

        if ($messageId !== null) {
            $this->view->setVar('success', View::getMessage('TASK_' . $messageId));
        }
        $this->view->renderHtml('task.php', ['task' => $task]);
    }

    /**
     * 
     */
    public function edit(int $taskId): void
    {
        $task = Task::getById($taskId);
        if ($task === null) {
            throw new NotFoundException();
        }

        if ($this->user === null) {
            throw new UnauthorizedException();
        } elseif ($this->user->getRole() != 'admin') {
            throw new ForbiddenException();
        }

        if (isset($_POST['updatetask'])) {
            try {
                $task->updateTask($_POST);
                /*
                $user = User::signUp([
                    'username' => $_POST['username'],
                    'email' => $_POST['email'],
                    'password' => $_POST['password'],
                ]);
                */
            } catch (BadValueException $e) {
                $this->view->renderHtml(
                    'editTask.php',
                    [
                        'error' => $e->getMessage(),
                        'task' => $task,
                    ]
                );
                return;
            }
            header('Location: /tasks/' . $task->getId() . '/message/1', true, 302);
            exit();
        }

        $this->view->renderHtml('editTask.php', ['task' => $task]);
    }

    /**
     * 
     */
    public function add(): void
    {

        if (isset($_POST['addtask'])) {
            try {
                $task = Task::createTask($_POST);
                /*
                $user = User::signUp([
                    'username' => $_POST['username'],
                    'email' => $_POST['email'],
                    'password' => $_POST['password'],
                ]);
                */
            } catch (BadValueException $e) {
                $this->view->renderHtml('addTask.php', ['error' => $e->getMessage()]);
                return;
            }
            header('Location: /tasks/' . $task->getId() . '/message/0', true, 302);
            exit();
        }

        $this->view->renderHtml('addTask.php');
    }
}
