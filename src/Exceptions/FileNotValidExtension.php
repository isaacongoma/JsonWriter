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
    public function __construct($message, $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
