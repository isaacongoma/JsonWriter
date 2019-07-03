<?php

namespace Manojkiran\JsonWriter\Exceptions;

use \Exception;
use \Throwable;

class FileNotLoadedException extends Exception
{
    /**
     * Create new FileNotLoadedException instance
     *
     * @param string|null $message
     * @param int|null $name
     * @param \Throwable|null $previous
     * @throws Exception
     **/
    public function __construct($message = "Json File is Not Loaded", $code = 0,$previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
