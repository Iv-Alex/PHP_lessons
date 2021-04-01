<?php

namespace Ivalex\Services;

use Ivalex\Exceptions\EnvironmentException;

class Environment
{
    /**
     * @var object singleton Environment instance
     */
    private static $instance;
    /**
     * @var array App options
     */
    private static $appOptions = array();
    /**
     * @var array DataBase options
     */
    private static $dbOptions = array();
    /**
     * @var array App messeges
     */
    private static $messages = array();


    private function __construct()
    {
        // catch file errors
        set_error_handler(function ($errfile) {
            if (0 === error_reporting()) {
                return false;
            }
            throw new \ErrorException($errfile);
        });
        //get App settings
        try {
            $settings = require __DIR__ . '/../../settings.php';
            self::$appOptions = $settings['ApplicationOptions'];
            self::$dbOptions = $settings['db'];
        } catch (\ErrorException $e) {
            throw new EnvironmentException('Environment creation error (settings file not found): ' . $e->getMessage(), $e->getCode());
        }
        // get Lang messages
        try {
            self::$messages = include __DIR__ . '/../Views/Lang/' . self::getOption('language') . '/messages.php';
        } catch (\ErrorException $e) {
        }

        restore_error_handler();
    }

    /**
     * @return object Singleton Db instance
     */
    public static function getInstance(): self
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    /**
     * 
     */
    public static function getOption($option)
    {
        return self::$appOptions[$option] ?? null;
    }

    /**
     * @return array $dbOptions
     */
    public static function getDbOptions():array
    {
        return self::$dbOptions;
    }

    /**
     * @param $messageType messages group
     * @param $messageIdentity message $key
     * @return string message value
     */
    public static function getMessage($messageType, $messageIdentity): ?string
    {
        return self::$messages[$messageType][$messageIdentity] ?? null;
    }
}
