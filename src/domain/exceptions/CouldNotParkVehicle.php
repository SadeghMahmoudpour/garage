<?php

namespace Temperworks\Codechallenge\domain\exceptions;

class CouldNotParkVehicle extends \RuntimeException
{
    public static function becauseCapacityIsFull(): self
    {
        return new static("no capacity", 1001);
    }

    public static function becauseNoFloorAcceptsVehicle(): self
    {
        return new static("no empty floor", 1002);
    }
}