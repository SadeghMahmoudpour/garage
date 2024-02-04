<?php

namespace unit\domain\models;

use PHPUnit\Framework\TestCase;
use Temperworks\Codechallenge\domain\exceptions\CouldNotParkVehicle;
use Temperworks\Codechallenge\domain\models\Floor;
use Temperworks\Codechallenge\domain\models\Vehicle;

class FloorTest extends TestCase
{
    /**
     * @dataProvider provideTestDataForFloor
     */
    public function testFloorDoesAcceptVehicle(array $testCase)
    {
        $floor = new Floor($testCase["cap"], $testCase["excludeVehicleTypes"]);
        foreach ($testCase["currentVehicles"] as $currentVehicleSize) {
            $currentVehicle = new Vehicle($currentVehicleSize, "t");
            $floor->parkVehicle($currentVehicle);
        }

        $vehicle = new Vehicle($testCase["vehicleSize"], $testCase["vehicleType"]);

        $result = $floor->doesAcceptVehicle($vehicle);
        self::assertEquals($testCase["result"], $result);
    }

    /**
     * @dataProvider provideTestDataForFloor
     */
    public function testFloorParkVehicle(array $testCase)
    {
        $floor = new Floor($testCase["cap"], $testCase["excludeVehicleTypes"]);
        foreach ($testCase["currentVehicles"] as $currentVehicleSize) {
            $currentVehicle = new Vehicle($currentVehicleSize, "t");
            $floor->parkVehicle($currentVehicle);
        }

        $vehicle = new Vehicle($testCase["vehicleSize"], $testCase["vehicleType"]);

        if (!$testCase["result"]) {
            $this->expectException(CouldNotParkVehicle::class);
        } else {
            $this->expectNotToPerformAssertions();
        }
        $floor->parkVehicle($vehicle);
    }

    public function provideTestDataForFloor(): array
    {
        return [
            [[
                "cap" => 1,
                "excludeVehicleTypes" => [],
                "currentVehicles" => [],
                "vehicleType" => "v",
                "vehicleSize" => 1.0,
                "result" => true,
            ]],
            [[
                "cap" => 1,
                "excludeVehicleTypes" => [],
                "currentVehicles" => [],
                "vehicleType" => "v",
                "vehicleSize" => 0.5,
                "result" => true,
            ]],
            [[
                "cap" => 1,
                "excludeVehicleTypes" => [],
                "currentVehicles" => [],
                "vehicleType" => "v",
                "vehicleSize" => 1.5,
                "result" => false,
            ]],
            [[
                "cap" => 0,
                "excludeVehicleTypes" => [],
                "currentVehicles" => [],
                "vehicleType" => "v",
                "vehicleSize" => 1.0,
                "result" => false,
            ]],
            [[
                "cap" => 1,
                "excludeVehicleTypes" => [],
                "currentVehicles" => [0.5],
                "vehicleType" => "v",
                "vehicleSize" => 0.5,
                "result" => true,
            ]],
            [[
                "cap" => 1,
                "excludeVehicleTypes" => [],
                "currentVehicles" => [0.5],
                "vehicleType" => "v",
                "vehicleSize" => 1.0,
                "result" => false,
            ]],
            [[
                "cap" => 2,
                "excludeVehicleTypes" => [],
                "currentVehicles" => [0.5],
                "vehicleType" => "v",
                "vehicleSize" => 1.0,
                "result" => true,
            ]],
            [[
                "cap" => 1,
                "excludeVehicleTypes" => ["van"],
                "currentVehicles" => [],
                "vehicleType" => "van",
                "vehicleSize" => 0.5,
                "result" => false,
            ]],
        ];
    }
}