<?php

namespace Ivalex\Controllers;

use Ivalex\Services\Db;
use Ivalex\Views\View;

class MainController
{

    private $view;
    private $db;

    public function __construct()
    {
        $this->view = new View('default');
        $this->db = new Db();
    }

    public function main()
    {
        $tasks = $this->db->query('SELECT * FROM `tasks`;');
        $this->view->renderHtml('main.php', ['tasks' => $tasks]);
    }

    public function sayHello(string $name)
    {
        $this->view->renderHtml('hello.php', ['name' => $name]);
    }
}
