<?php

error_reporting(E_ALL);

use Ivalex\Views\View;


try {
    # autoload
    spl_autoload_register(function (string $className) {
        require_once __DIR__ .  '/../src/' . str_replace('\\', '/', $className) . '.php';
    });

    # routing
    $controllerAction = routeToControllerAction(
        strtolower(($_GET['route'] ?? '')),
        require __DIR__ . '/../src/routes.php'
    );
    # except page not found if route does not match any pattern
    if ($controllerAction === null) {
        throw new Ivalex\Exceptions\NotFoundException();
    }

    # get the required controller name
    $controllerName = $controllerAction['controllerName'];
    # get the required action
    $actionName = $controllerAction['actionName'];

    # create the controller's object and launch the action
    $controller = new $controllerName;
    $controller->$actionName(...$controllerAction['params']);

} catch (Ivalex\Exceptions\DbException $e) {
    showErrorPage($e);
} catch (Ivalex\Exceptions\NotFoundException $e) {
    showErrorPage($e);
} catch (Ivalex\Exceptions\UnauthorizedException $e) {
    showErrorPage($e);
} catch (Ivalex\Exceptions\ForbiddenException $e) {
    showErrorPage($e);
}

/**
 * 
 */
function routeToControllerAction(string $route, array $routes): ?array
{
    # split the route into parts using patterns: controller name, action and parameters
    $routeFound = false;
    foreach ($routes as $pattern => $controllerAction) {
        preg_match($pattern, $route, $matches);
        if (!empty($matches)) {
            $routeFound = true;
            break;
        }
    }

    # return null if route does not match any pattern
    if (!$routeFound) {
        return null;
    }

    # remove full route match
    unset($matches[0]);

    return [
        # get the controller name
        'controllerName' => $controllerAction[0],
        # get the action
        'actionName' => $controllerAction[1],
        # get the params
        'params' => $matches,
    ];
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
