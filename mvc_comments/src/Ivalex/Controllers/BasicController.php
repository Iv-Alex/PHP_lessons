<?php

namespace Ivalex\Controllers;

use Ivalex\Views\View;

/**
 * basic
 */
abstract class BasicController
{
    private static $appOptions = array();
    protected $view;

    public function __construct()
    {
        // get App settings
        if (empty(self::$appOptions)) {
            self::$appOptions = (require __DIR__ . '/../../settings.php')['ApplicationOptions'];
        }
        $this->view = new View(self::$appOptions['template']);
    }

    public static function getOption($option)
    {
        return self::$appOptions[$option];
    }
}
