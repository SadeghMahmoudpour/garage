<?php

namespace Temperworks\Codechallenge\models\memory;

use Temperworks\Codechallenge\exceptions\NoCapacityException;
use Temperworks\Codechallenge\models\FloorInterface;
use Temperworks\Codechallenge\models\ParkingInterface;
use Temperworks\Codechallenge\models\VehicleInterface;

class Parking implements ParkingInterface
{
    /**
     * @param FloorInterface[]|array $floors
     */
    public function __construct(private array $floors)
    {
    }

    public function doesAcceptVehicle(VehicleInterface $vehicle): bool
    {
        return !is_null($this->getFirstEmptyFloor($vehicle));
    }

    public function parkVehicle(VehicleInterface $vehicle): void
    {
        $floor = $this->getFirstEmptyFloor($vehicle);
        if (is_null($floor)) {
            throw new NoCapacityException();
        }

        $floor->parkVehicle($vehicle);
    }

    private function getFirstEmptyFloor(VehicleInterface $vehicle): ?FloorInterface
    {
        foreach ($this->floors as $floor) {
            if ($floor->doesAcceptVehicle($vehicle)) {
                return $floor;
            }
        }

        return null;
    }
}