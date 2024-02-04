<?php

namespace Temperworks\Codechallenge\infrastructure\repository\memory;

use Temperworks\Codechallenge\domain\models\Parking;
use Temperworks\Codechallenge\domain\repositories\ParkingRepositoryInterface;

class ParkingRepository implements ParkingRepositoryInterface
{
    private ?Parking $parking = null;

    public function create(Parking $parking): Parking
    {
        $this->parking = $parking;

        return $parking;
    }

    public function find(): ?Parking
    {
        return $this->parking;
    }

    public function save(Parking $parking): void
    {
        $this->parking = $parking;
    }
}