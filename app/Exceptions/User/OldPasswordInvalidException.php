<?php

namespace App\Exceptions\User;

use App\Exceptions\FlushSessionAlertException;

class OldPasswordInvalidException extends FlushSessionAlertException
{
    function getAlertMessage(): string
    {
        return "Old password is invalid";
    }
}
