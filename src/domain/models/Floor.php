<?php

namespace Temperworks\Codechallenge\domain\models;

use Temperworks\Codechallenge\domain\exceptions\CouldNotParkVehicle;

class Floor
{
    /**
     * @var Vehicle[]|array
     */
    private array $vehicles = [];

    public function __construct(
        private float $capacity,
        private array $excludedVehicleTypes = []
    )
    {
    }

    public function doesAcceptVehicle(Vehicle $vehicle): bool
    {
        return !in_array($vehicle->getType(), $this->excludedVehicleTypes) &&
            $this->getRemainingCapacity() >= $vehicle->getSize();
    }

    public function parkVehicle(Vehicle $vehicle): void
    {
        if (!$this->doesAcceptVehicle($vehicle)) {
            throw CouldNotParkVehicle::becauseCapacityIsFull();
        }

        $this->vehicles[] = $vehicle;
    }

    private function getRemainingCapacity()
    {
        return $this->capacity - array_reduce($this->vehicles, function (float $sum, Vehicle $vehicle) {
                return $sum + $vehicle->getSize();
            }, 0);
    }
}