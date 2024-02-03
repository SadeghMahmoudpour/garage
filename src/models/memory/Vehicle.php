<?php

namespace Temperworks\Codechallenge\models\memory;

use Temperworks\Codechallenge\models\VehicleInterface;

class Vehicle implements VehicleInterface
{
    public function __construct(private float $size, private string $type)
    {
    }

    public function getSize(): float
    {
        return $this->size;
    }

    public function getType(): string
    {
        return $this->type;
    }
}