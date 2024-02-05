<?php

namespace Temperworks\Codechallenge\infrastructure\console;

use Temperworks\Codechallenge\application\usecase\checkCapacity\CheckCapacity;
use Temperworks\Codechallenge\application\usecase\checkCapacity\CheckCapacityHandler;
use Temperworks\Codechallenge\application\usecase\createParking\CreateParking;
use Temperworks\Codechallenge\application\usecase\createParking\CreateParkingHandler;
use Temperworks\Codechallenge\application\usecase\parkVehicle\ParkVehicle;
use Temperworks\Codechallenge\application\usecase\parkVehicle\ParkVehicleHandler;
use Temperworks\Codechallenge\domain\exceptions\CouldNotCreateVehicleException;
use Temperworks\Codechallenge\domain\services\ParkingService;
use Temperworks\Codechallenge\domain\services\VehicleFactory;
use Temperworks\Codechallenge\infrastructure\repository\memory\ParkingRepository;

class ApplicationCommand
{
    const FLOORS_COUNT = 3;

    public function execute()
    {
        $capacities = [];
        for ($i = 1; $i <= self::FLOORS_COUNT; $i++) {
            echo "Floor $i capacity:";
            $cap = readline();
            if (!is_numeric($cap)) {
                echo "invalid capacity\n";
                $i--;
            } else {
                $capacities[] = $cap;
            }
        }

        $parkingRepository = new ParkingRepository();

        $parkingService  = new ParkingService($parkingRepository);
        $vehicleFactory = new VehicleFactory();

        $createParkingHandler = new CreateParkingHandler($parkingService);
        $createParkingHandler->create(new CreateParking($capacities));

        $checkCapacityHandler = new CheckCapacityHandler($vehicleFactory, $parkingService);
        $parkVehicleHandler = new ParkVehicleHandler($vehicleFactory, $parkingService);

        while (true) {
            echo "New Vehicle: ";
            $vehicleType = readline();

            try {
                if ($checkCapacityHandler->check(new CheckCapacity($vehicleType))) {
                    echo "Welcome, please go in\n";
                    $parkVehicleHandler->park(new ParkVehicle($vehicleType));
                } else {
                    echo "Sorry, no spaces left\n";
                }
            } catch (CouldNotCreateVehicleException $exception) {
                echo $exception->getMessage();
                echo "\n";
            }
        }
    }
}
