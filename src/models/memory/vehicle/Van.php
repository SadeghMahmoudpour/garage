<?php

namespace Temperworks\Codechallenge\models\memory\vehicle;

use Temperworks\Codechallenge\models\VehicleInterface;

class Van implements VehicleInterface
{
    public const TYPE = "VAN";

    private const SIZE = 1.5;

    public function getSize(): float
    {
       return self::SIZE;
    }

    public function getType(): string
    {
        return self::TYPE;
    }
}