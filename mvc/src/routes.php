<?php

return [
    '~^tasks/(\d+)$~i' => [\Ivalex\Controllers\TasksController::class, 'view'],
    '~^tasks/new$~i' => [\Ivalex\Controllers\TasksController::class, 'new'],
    '~^$~i' => [\Ivalex\Controllers\MainController::class, 'main'],
];