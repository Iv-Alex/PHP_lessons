<?php

namespace Ivalex\Controllers;

use Ivalex\Views\View;
use Ivalex\Models\Tasks\Task;

class MainController
{

    private $view;

    public function __construct()
    {
        $this->view = new View('default');
    }

    public function main()
    {
        $tasks = Task::getAllRecords();
        $this->view->renderHtml('main.php', ['tasks' => $tasks]);
    }
}
