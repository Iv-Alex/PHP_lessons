<?php

namespace Ivalex\Exceptions;

use Ivalex\Services\Environment;

class BadValueException extends \Exception
{
    public function __construct(string $message, int $code)
    {
        $this->message = Environment::getInstance()->getMessage('BAD_VALUE_EXCEPTION', $code) ?? $message;
    }
}
