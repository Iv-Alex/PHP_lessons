<?php

return [
    '~^tasks/(\d+)$~i' => [\Ivalex\Controllers\TasksController::class, 'view'],
    '~^tasks/(\d+)/edit$~i' => [\Ivalex\Controllers\TasksController::class, 'edit'],
    '~^tasks/add$~i' => [\Ivalex\Controllers\TasksController::class, 'add'],
    '~^$~i' => [\Ivalex\Controllers\MainController::class, 'main'],
];