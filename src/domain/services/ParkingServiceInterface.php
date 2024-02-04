<?php

namespace Temperworks\Codechallenge\domain\services;

use Temperworks\Codechallenge\domain\models\Parking;
use Temperworks\Codechallenge\domain\models\Vehicle;

interface ParkingServiceInterface
{
    public function createParking(Parking $parking): Parking;

    public function checkCapacity(Vehicle $vehicle): bool;

    public function parkVehicle(Vehicle $vehicle): void;
}