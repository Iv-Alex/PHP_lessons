<?php

return [
    '~^hello/(.*)$~' => [\Ivalex\Controllers\MainController::class, 'sayHello'],
    '~^$~' => [\Ivalex\Controllers\MainController::class, 'main'],
];