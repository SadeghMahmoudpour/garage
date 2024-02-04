<?php

namespace Temperworks\Codechallenge\domain\repositories;

use Temperworks\Codechallenge\domain\models\Parking;

interface ParkingRepositoryInterface
{
    public function create(Parking $parking): Parking;

    public function find(): ?Parking;

    public function save(Parking $parking): void;
}
