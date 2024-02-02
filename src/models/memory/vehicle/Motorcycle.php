<?php

namespace Temperworks\Codechallenge\models\memory\vehicle;

use Temperworks\Codechallenge\models\VehicleInterface;

class Motorcycle implements VehicleInterface
{
    public const TYPE = "MOTORCYCLE";

    private const SIZE = 0.5;

    public function getSize(): float
    {
        return self::SIZE;
    }

    public function getType(): string
    {
        return self::TYPE;
    }
}
