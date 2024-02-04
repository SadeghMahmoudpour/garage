<?php

namespace Temperworks\Codechallenge\application\usecase\checkCapacity;

use Temperworks\Codechallenge\domain\services\ParkingServiceInterface;
use Temperworks\Codechallenge\domain\services\VehicleFactoryInterface;

class CheckCapacityHandler
{
    public function __construct(
        private VehicleFactoryInterface $vehicleFactory,
        private ParkingServiceInterface $parkingService
    ) {
    }

    public function check(CheckCapacity $checkCapacity): bool
    {
        $vehicle = $this->vehicleFactory->create($checkCapacity->getVehicleType());

        return $this->parkingService->checkCapacity($vehicle);
    }
}