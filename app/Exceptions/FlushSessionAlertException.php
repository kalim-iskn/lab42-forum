<?php

namespace App\Exceptions;

use Exception;
use Throwable;

abstract class FlushSessionAlertException extends Exception
{
    public function __construct(string $message = "", int $code = 0, ?Throwable $previous = null)
    {
        if (empty($message)) {
            $message = $this->getAlertMessage();
        }

        parent::__construct($message, $code, $previous);
    }

    abstract function getAlertMessage(): string;
}
