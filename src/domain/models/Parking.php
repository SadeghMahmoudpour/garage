<?php

namespace Temperworks\Codechallenge\domain\models;

use Temperworks\Codechallenge\domain\exceptions\CouldNotParkVehicle;

class Parking
{
    /**
     * @param Floor[]|array $floors
     */
    public function __construct(private array $floors = [])
    {
    }

    public function doesAcceptVehicle(Vehicle $vehicle): bool
    {
        return !is_null($this->getFirstEmptyFloor($vehicle));
    }

    public function parkVehicle(Vehicle $vehicle): void
    {
        $floor = $this->getFirstEmptyFloor($vehicle);
        if (is_null($floor)) {
            throw CouldNotParkVehicle::becauseNoFloorAcceptsVehicle();
        }

        $floor->parkVehicle($vehicle);
    }

    private function getFirstEmptyFloor(Vehicle $vehicle): ?Floor
    {
        foreach ($this->floors as $floor) {
            if ($floor->doesAcceptVehicle($vehicle)) {
                return $floor;
            }
        }

        return null;
    }
}