<?php

namespace Temperworks\Codechallenge\domain\services;

use Temperworks\Codechallenge\domain\exceptions\CouldNotCreateVehicleException;
use Temperworks\Codechallenge\domain\models\Vehicle;
use Temperworks\Codechallenge\domain\models\vehicles\Car;
use Temperworks\Codechallenge\domain\models\vehicles\Motorcycle;
use Temperworks\Codechallenge\domain\models\vehicles\Van;

class VehicleFactory implements VehicleFactoryInterface
{
    public function create(string $type): Vehicle
    {
        switch ($type) {
            case Car::TYPE:
                return new Car();
            case Van::TYPE:
                return new Van();
            case Motorcycle::TYPE:
                return new Motorcycle();
            default:
                throw CouldNotCreateVehicleException::becauseVehicleTypeIsInvalid();
        }
    }
}