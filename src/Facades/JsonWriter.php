<?php

namespace Manojkiran\JsonWriter;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Manojkiran\JsonWriter\
 */
class JsonWriter extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'jsonwriter';
    }
}
