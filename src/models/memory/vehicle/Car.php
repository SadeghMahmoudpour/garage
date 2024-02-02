<?php

namespace Temperworks\Codechallenge\models\memory\vehicle;

use Temperworks\Codechallenge\models\VehicleInterface;

class Car implements VehicleInterface
{
    public const TYPE = "CAR";

    private const SIZE = 1;

    public function getSize(): float
    {
        return self::SIZE;
    }

    public function getType(): string
    {
        return self::TYPE;
    }
}