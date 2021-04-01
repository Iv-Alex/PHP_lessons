<?php
/**
 * the router works with strtolower(route)
 */
return [
    '~^add$~' => [\Ivalex\Controllers\CommentsController::class, 'addComment'],
    '~^$~' => [\Ivalex\Controllers\CommentsController::class, 'singlePage'],
];