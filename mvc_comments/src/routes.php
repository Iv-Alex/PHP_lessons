<?php
/**
 * the router works with strtolower(route)
 */
return [
    '~^add$~' => [\Ivalex\Controllers\CommentsController::class, 'addComment'],
    '~^add/ajax$~' => [\Ivalex\Controllers\CommentsController::class, 'ajaxAddComment'],
    '~^$~' => [\Ivalex\Controllers\CommentsController::class, 'singlePage'],
];