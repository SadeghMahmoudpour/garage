<?php

namespace Temperworks\Codechallenge\models;

interface FloorInterface
{
    public function doesAcceptVehicle(VehicleInterface $vehicle): bool;

    public function parkVehicle(VehicleInterface $vehicle): void;
}