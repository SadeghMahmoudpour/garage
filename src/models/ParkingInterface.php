<?php

namespace Temperworks\Codechallenge\models;

interface ParkingInterface
{
    public function doesAcceptVehicle(VehicleInterface $vehicle): bool;

    public function parkVehicle(VehicleInterface $vehicle);
}