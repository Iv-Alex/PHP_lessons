<?php

namespace Ivalex\Controllers;

use Ivalex\Views\View;

class MainController
{

    private $view;

    public function __construct()
    {
        $this->view = new View(__DIR__ . '/../../../templates');
    }

    public function main()
    {
        $tasks = [
            ['title' => 'task1', 'text' => 'text1'],
            ['title' => 'task2', 'text' => 'text2'],
            ['title' => 'task3', 'text' => 'text3'],
        ];
        $this->view->renderHtml('main/main.php', ['tasks' => $tasks]);
    }

    public function sayHello(string $name)
    {
        $this->view->renderHtml('main/hello.php', ['name' => $name]);
    }
}
