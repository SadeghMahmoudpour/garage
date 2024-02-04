<?php

namespace Temperworks\Codechallenge\application\usecase\parkVehicle;

use Temperworks\Codechallenge\domain\services\ParkingServiceInterface;
use Temperworks\Codechallenge\domain\services\VehicleFactoryInterface;

class ParkVehicleHandler
{
    public function __construct(
        private VehicleFactoryInterface $vehicleFactory,
        private ParkingServiceInterface $parkingService
    )
    {
    }

    public function park(ParkVehicle $parkVehicleRequest): void
    {
        $vehicle = $this->vehicleFactory->create($parkVehicleRequest->getVehicleType());
        $this->parkingService->parkVehicle($vehicle);
    }
}
