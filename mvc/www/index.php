<?php

error_reporting(E_ALL);

use Ivalex\Views\View;

try {
    // autoload
    spl_autoload_register(function (string $className) {
        require_once __DIR__ .  '/../src/' . str_replace('\\', '/', $className) . '.php';
    });

    // routing
    $route = strtolower(($_GET['route'] ?? ''));

    $routes = require __DIR__ . '/../src/routes.php';

    $routeFound = false;
    foreach ($routes as $pattern => $controllerAction) {
        preg_match($pattern, $route, $matches);
        if (!empty($matches)) {
            $routeFound = true;
            break;
        }
    }

    if (!$routeFound) {
        throw new Ivalex\Exceptions\NotFoundException();
    }

    unset($matches[0]);

    // get the required controller name
    $controllerName = $controllerAction[0];
    // get the required action
    $actionName = $controllerAction[1];
    // create the controller's object and launch the action
    $controller = new $controllerName();

    $controller->$actionName(...$matches);
} catch (Ivalex\Exceptions\DbException $e) {
    showErrorPage($e);
} catch (Ivalex\Exceptions\NotFoundException $e) {
    showErrorPage($e);
} catch (Ivalex\Exceptions\UnauthorizedException $e) {
    showErrorPage($e);
} catch (Ivalex\Exceptions\ForbiddenException $e) {
    showErrorPage($e);
}

function showErrorPage($e)
{
    $view = new View('default', false);
    $view->renderHtml(
        'error.php',
        [
            'errorCode' => $e->getCode(),
            'errorMessage' => $e->getMessage(),
        ],
        $e->getCode()
    );
}
