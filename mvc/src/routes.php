<?php

return [
    '~^tasks/(\d+)$~' => [\Ivalex\Controllers\TasksController::class, 'view'],
    '~^$~' => [\Ivalex\Controllers\MainController::class, 'main'],
];