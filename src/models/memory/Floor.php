<?php

namespace Temperworks\Codechallenge\models\memory;

use Temperworks\Codechallenge\exceptions\NoCapacityException;
use Temperworks\Codechallenge\models\FloorInterface;
use Temperworks\Codechallenge\models\VehicleInterface;

class Floor implements FloorInterface
{
    /**
     * @var VehicleInterface[]|array
     */
    private array $vehicles = [];

    public function __construct(
        private float $capacity,
        private array $excludeVehicles = []
    )
    {
    }

    public function doesAcceptVehicle(VehicleInterface $vehicle): bool
    {
        return !in_array($vehicle->getType(), $this->excludeVehicles) &&
            $this->getRemainingCapacity() >= $vehicle->getSize();
    }

    public function parkVehicle(VehicleInterface $vehicle): void
    {
        if (!$this->doesAcceptVehicle($vehicle)) {
            throw new NoCapacityException();
        }

        $this->vehicles[] = $vehicle;
    }

    private function getRemainingCapacity()
    {
        return $this->capacity - array_reduce($this->vehicles, function (float $sum, VehicleInterface $vehicle) {
                return $sum + $vehicle->getSize();
            }, 0);
    }
}