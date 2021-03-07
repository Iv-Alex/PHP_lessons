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

        if (isset($_POST['updatetask'])) {
            if (($this->user === null) || ($this->user->getRole() != 'admin')) {
                header('Location: /users/login');
                exit();
            }

            try {
                // will use Prepared Statements to insert data into SQL query
                $task = updateTask([
                    'text' => $_POST['text'],
                    'status' => $_POST['status'],
                ]);
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
        } else {
            if ($this->user === null) {
                throw new UnauthorizedException();
            } elseif ($this->user->getRole() != 'admin') {
                throw new ForbiddenException();
            }
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
                // will use Prepared Statements to insert data into SQL query
                $task = Task::createTask([
                    'username' => $_POST['username'],
                    'email' => $_POST['email'],
                    'text' => $_POST['text'],
                ]);
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
