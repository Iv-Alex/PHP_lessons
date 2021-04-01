<?php
/**
 * the router works with strtolower(route)
 */
return [
    '~^tasks/add$~' => [\Ivalex\Controllers\TasksController::class, 'add'],
    '~^$~' => [\Ivalex\Controllers\CommentsController::class, 'singlePage'],
];