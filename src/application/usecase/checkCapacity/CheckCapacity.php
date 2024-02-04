<?php

namespace Temperworks\Codechallenge\application\usecase\checkCapacity;

use Temperworks\Codechallenge\domain\models\vehicles;

class CheckCapacity
{
    public function __construct(private string $vehicleType)
    {
    }

    public function getVehicleType(): string
    {
        return $this->vehicleType;
    }
}