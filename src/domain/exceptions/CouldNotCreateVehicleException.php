<?php

namespace Temperworks\Codechallenge\domain\exceptions;

class CouldNotCreateVehicleException extends \InvalidArgumentException
{
    public static function becauseVehicleTypeIsInvalid()
    {
        return new static("invalid vehicle type", 1000);
    }
}