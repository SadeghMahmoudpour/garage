<?php

namespace Temperworks\Codechallenge\exceptions;

use Exception;

class NoCapacityException extends Exception
{
    public function __construct(string $message = "no capacity")
    {
        parent::__construct($message);
    }
}
