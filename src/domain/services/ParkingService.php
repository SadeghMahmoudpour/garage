<?php

namespace Temperworks\Codechallenge\domain\services;

use Temperworks\Codechallenge\domain\models\Parking;
use Temperworks\Codechallenge\domain\models\Vehicle;
use Temperworks\Codechallenge\domain\repositories\ParkingRepositoryInterface;

class ParkingService implements ParkingServiceInterface
{
    public function __construct(private ParkingRepositoryInterface $parkingRepository)
    {
    }

    public function createParking(Parking $parking): Parking
    {
        return $this->parkingRepository->create($parking);
    }

    public function checkCapacity(Vehicle $vehicle): bool
    {
        $parking = $this->parkingRepository->find();

        return $parking->doesAcceptVehicle($vehicle);
    }

    public function parkVehicle(Vehicle $vehicle): void
    {
        $parking = $this->parkingRepository->find();
        $parking->parkVehicle($vehicle);
        $this->parkingRepository->save($parking);
    }
}