<?php

namespace Ivalex\Controllers;

use Ivalex\Views\View;
use Ivalex\Services\Environment;

/**
 * basic
 */
abstract class BasicController
{
    protected $view;

    public function __construct()
    {
        $this->view = new View(Environment::getInstance()->getOption('template'));
    }
}
