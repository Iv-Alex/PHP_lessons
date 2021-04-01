<?php

namespace Ivalex\Views;

use Ivalex\Controllers\BasicController;

/**
 * @var string $templatePath
 * @var array $templateParts - $partName => $partFileName ($pageHeader, $pageFooter etc.)
 * @var array $extraVars - additional preset var pairs $key => $value
 */
class View
{
    private $templatePath;
    private $templateParts = [];
    private $extraVars = [];
    private static $messages = array();

    public function __construct(string $templateDir, bool $useMessenges = true)
    {
        $templatesPath = __DIR__ . '/../../../templates';
        $this->templatePath = $templatesPath . '/' . $templateDir;

        // get Lang messages
        if ($useMessenges && empty(self::$messages)) {
            self::$messages = include __DIR__ . '/Lang/' . BasicController::getOption('language') . '/messages.php';
        }
    }

    /**
     * @param string $messageIdentity message name
     * @return string message value
     */
    public static function getMessage(string $messageIdentity): string
    {
        return self::$messages[$messageIdentity];
    }

    /**
     * Add variables before rendering the page
     */
    public function setVar(string $name, $value): void
    {
        $this->extraVars[$name] = $value;
    }

    /**
     * Add variables before rendering the page
     */
    public function setTemplatePart(string $partName, string $partFileName): void
    {
        $this->templateParts[$partName] = $partFileName;
    }

    /**
     * creates html page using variables ($vars)
     *
     * @param string $templateName name of the page template
     * @param array $vars array of variables [...[$key => $value]] using in the page
     */
    public function renderHtml(string $templateName, array $vars = [], int $httpStatusCode = 200)
    {
        // send processed HTTP status code
        http_response_code($httpStatusCode);
        // get additional preset vars
        extract($this->extraVars);
        // get variables
        extract($vars);
        // get template parts
        foreach ($this->templateParts as $partName => $partFileName) {
            $partFilePath = $this->templatePath . '/' . $partFileName;
            if (file_exists($partFilePath)) {
                ob_start();
                include $partFilePath;
                $templateParts[$partName] = ob_get_contents();
                ob_end_clean();
            } else {
                $templateParts[$partName] = '';
            }
        }
        extract($templateParts);

        // put the page in the buffer
        ob_start();
        include $this->templatePath . '/' . $templateName;
        $buffer = ob_get_contents();
        ob_end_clean();

        // send the page to user
        echo $buffer;
    }
}
