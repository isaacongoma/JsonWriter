<?php

namespace Manojkiran\JsonWriter\Exceptions;

use \Exception;
use \Throwable;

class FileNotValidExtension extends Exception
{
    /**
     * Create new FileNotValidExtension instance
     *
     * @param string $fileName
     * @param string $message
     * @param int $code
     * @param \Throwable $previous
     * @throws Exception
     **/
    public function __construct($message = "is Not a Valid Json File", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
