<?php

namespace Ivalex\Exceptions;

class UnauthorizedException extends \Exception
{
    public function __construct()
    {
        $this->message = 'Unauthorized. Permission denied';
        $this->code = 401;
    }
}