<?php

namespace Ivalex\Exceptions;

class ForbiddenException extends \Exception
{
    public function __construct()
    {
        $this->message = 'Forbidden. Access denied.';
        $this->code = 403;
    }
}
