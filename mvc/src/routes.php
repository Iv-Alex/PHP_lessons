<?php
/**
 * the router works with strtolower(route)
 */
return [
    '~^users/login$~' => [\Ivalex\Controllers\UsersController::class, 'login'],
    '~^users/logout$~' => [\Ivalex\Controllers\UsersController::class, 'logout'],
    '~^users/register$~' => [\Ivalex\Controllers\UsersController::class, 'signUp'],
    '~^tasks/(\d+)$~' => [\Ivalex\Controllers\TasksController::class, 'view'],
    '~^tasks/(\d+)/edit$~' => [\Ivalex\Controllers\TasksController::class, 'edit'],
    '~^tasks/add$~' => [\Ivalex\Controllers\TasksController::class, 'add'],
    '~^$~' => [\Ivalex\Controllers\MainController::class, 'main'],
    '~^page/(\d+)(?:|/(\d{1,2})/([01]))$~' => [\Ivalex\Controllers\MainController::class, 'main'],
];