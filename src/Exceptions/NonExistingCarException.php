<?php

namespace App\Exceptions;

use Exception;
use Throwable;

class NonExistingCarException extends Exception
{
    /**
     * @param string $message
     * @param int $code
     * @param Throwable|null $previous
     */
    public function __construct(string $message = 'Car does not exist.', int $code = 404, ?Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
