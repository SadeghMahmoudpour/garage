<?php

namespace Temperworks\Codechallenge\domain\services;

use Temperworks\Codechallenge\domain\models\Vehicle;

interface VehicleFactoryInterface
{
    public function create(string $type): Vehicle;
}