<?php

namespace Manojkiran\JsonWriter\Exceptions;

use \Exception;
use \Throwable;

class FileNotLoadedException extends Exception
{
    /**
     * Create new FileNotLoadedException instance
     *
     * @param string $fileName
     * @param string $message
     * @param int $code
     * @param \Throwable $previous
     * @throws Exception
     **/
    public function __construct($message = "Json File is Not Loaded", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
