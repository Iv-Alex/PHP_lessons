<?php

namespace Ivalex\Views;

class View
{
    private $templatePath;

    public function __construct(string $templateDir)
    {
        $templatesPath = __DIR__ . (require __DIR__ . '/../../settings.php')['templatesPath'];
        $this->templatePath = $templatesPath . '/' . $templateDir;
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
        // get variables
        extract($vars);

        // put the page in the buffer
        ob_start();
        include $this->templatePath . '/' . $templateName;
        $buffer = ob_get_contents();
        ob_end_clean();

        // send the page to user
        echo $buffer;
    }
}
