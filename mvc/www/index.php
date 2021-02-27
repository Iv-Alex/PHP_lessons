<?php

error_reporting(E_ALL);

// autoload
spl_autoload_register(function (string $className) {
    require_once __DIR__ .  '/../src/' . str_replace('\\', '/', $className) . '.php';
});

// routing
$route = $_GET['route'] ?? '';
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
    echo '404 page not found';
}

unset($matches[0]);

$controllerName = $controllerAction[0];
$actionName = $controllerAction[1];

$controller = new $controllerName();
$controller->$actionName(...$matches);

