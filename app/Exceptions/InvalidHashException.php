<?php

namespace App\Exceptions;

use Exception;

class InvalidHashException extends Exception
{
    public function __construct($message = "Invalid short URL code", $code = 400, ?Exception $previous = null) {
        parent::__construct($message, $code, $previous);
    }
}
