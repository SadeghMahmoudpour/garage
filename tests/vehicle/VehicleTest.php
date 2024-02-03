<?php

namespace vehicle;

use PHPUnit\Framework\TestCase;
use Temperworks\Codechallenge\models\memory\Vehicle;

class VehicleTest extends TestCase
{
    public function testVehicle()
    {
        $size = 0.5;
        $type = "type";
        $vehicle = new Vehicle($size, $type);
        self::assertEquals($type, $vehicle->getType());
        self::assertEquals($size, $vehicle->getSize());
    }
}