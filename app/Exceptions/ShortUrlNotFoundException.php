<?php

namespace App\Exceptions;

use Exception;

class ShortUrlNotFoundException extends Exception
{
    public function __construct(string $message = 'Short URL not found',int $code = 404) 
    {
        parent::__construct($message, $code);
    }
}
