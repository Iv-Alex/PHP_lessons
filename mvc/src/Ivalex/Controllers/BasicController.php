<?php

namespace Ivalex\Controllers;

use Ivalex\Models\Users\UsersAuthService;
use Ivalex\Views\View;

/**
 * basic
 */
abstract class BasicController
{
    private static $appOptions = array();
    protected $view;
    protected $user;

    public function __construct()
    {
        if (empty(self::$appOptions)) {
            self::$appOptions = (require __DIR__ . '/../../settings.php')['ApplicationOptions'];
        }
        $this->user = UsersAuthService::getUserByToken();
        $this->view = new View(self::$appOptions['template']);
        $this->view->setVar('user', $this->user);
    }

    public static function getOption($option)
    {
        return self::$appOptions[$option];
    }
}
