<?php

namespace Temperworks\Codechallenge\application\usecase\parkVehicle;

class ParkVehicle
{
    public function __construct(private string $vehicleType)
    {
    }

    public function getVehicleType(): string
    {
        return $this->vehicleType;
    }
}