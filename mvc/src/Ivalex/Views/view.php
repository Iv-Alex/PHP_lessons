<?php

namespace Ivalex\Views;

/**
 * @var string $templatePath
 * @var array $extraVars - additional preset vars
 */
class View
{
    private $templatePath;
    private $extraVars = [];

    public function __construct(string $templateDir)
    {
        $templatesPath = __DIR__ . '/../../../templates';
        $this->templatePath = $templatesPath . '/' . $templateDir;
    }

    //! delete it
    public static function echoIt($anything)
    {
        echo '<pre>';
        var_dump($anything);
        echo '</pre>';
    }

    /**
     * Add variables before rendering the page
     */
    public function setVar(string $name, $value): void
    {
        $this->extraVars[$name] = $value;
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

        // put the page in the buffer
        ob_start();
        include $this->templatePath . '/' . $templateName;
        $buffer = ob_get_contents();
        ob_end_clean();

        // send the page to user

        View::echoIt('-------------------------- XSS attacks in forms (before send params for save)');
        View::echoIt('---error width --------');

        echo $buffer;
    }
}
