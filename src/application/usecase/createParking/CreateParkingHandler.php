<?php

namespace Temperworks\Codechallenge\application\usecase\createParking;

use Temperworks\Codechallenge\domain\models\Floor;
use Temperworks\Codechallenge\domain\models\Parking;
use Temperworks\Codechallenge\domain\models\vehicles\Van;
use Temperworks\Codechallenge\domain\services\ParkingServiceInterface;

class CreateParkingHandler
{
    public function __construct(
        private ParkingServiceInterface $parkingService
    )
    {
    }

    public function create(CreateParking $createParking): Parking
    {
        $floors = [];
        foreach ($createParking->getCapacities() as $i => $capacity) {
            $excludedVehicles = [];
            if ($i > 0) {
                $excludedVehicles[] = Van::TYPE;
            }
            $floors[] = new Floor($capacity, $excludedVehicles);
        }

        return $this->parkingService->createParking(new Parking($floors));
    }
}