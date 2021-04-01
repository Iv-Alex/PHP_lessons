<?php

namespace Ivalex\Exceptions;

class NotFoundException extends \Exception
{
    public function __construct()
    {
        $this->message = 'Page not found';
        $this->code = 404;
    }
}
