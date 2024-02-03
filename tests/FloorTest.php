<?php

use PHPUnit\Framework\TestCase;
use Temperworks\Codechallenge\exceptions\NoCapacityException;
use Temperworks\Codechallenge\models\memory\Floor;
use Temperworks\Codechallenge\models\VehicleInterface;

class FloorTest extends TestCase
{
    /**
     * @dataProvider provideTestDataForFloorDoesAcceptVehicle
     */
    public function testFloorDoesAcceptVehicle(array $testCase)
    {
        $floor = new Floor($testCase["cap"], $testCase["excludeVehicleTypes"]);
        foreach ($testCase["currentVehicles"] as $currentVehicleSize) {
            $currentVehicle = $this->createStub(VehicleInterface::class);
            $currentVehicle->method("getSize")->willReturn($currentVehicleSize);
            $floor->parkVehicle($currentVehicle);
        }

        $vehicle = $this->createStub(VehicleInterface::class);
        $vehicle->method("getType")->willReturn($testCase["vehicleType"]);
        $vehicle->method("getSize")->willReturn($testCase["vehicleSize"]);

        $result = $floor->doesAcceptVehicle($vehicle);
        self::assertEquals($testCase["result"], $result);
    }

    /**
     * @dataProvider provideTestDataForFloorParkVehicle
     */
    public function testFloorParkVehicle(array $testCase)
    {
        $floor = new Floor($testCase["cap"], $testCase["excludeVehicleTypes"]);
        foreach ($testCase["currentVehicles"] as $currentVehicleSize) {
            $currentVehicle = $this->createStub(VehicleInterface::class);
            $currentVehicle->method("getSize")->willReturn($currentVehicleSize);
            $floor->parkVehicle($currentVehicle);
        }

        $vehicle = $this->createVehicleStub($testCase["vehicleSize"], $testCase["vehicleType"]);

        if ($testCase["exception"]) {
            $this->expectException($testCase["exception"]);
        } else {
            $this->expectNotToPerformAssertions();
        }
        $floor->parkVehicle($vehicle);
    }

    public function provideTestDataForFloorDoesAcceptVehicle()
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

    public function provideTestDataForFloorParkVehicle()
    {
        return [
            [[
                "cap" => 1,
                "excludeVehicleTypes" => [],
                "currentVehicles" => [],
                "vehicleType" => "v",
                "vehicleSize" => 1.0,
                "exception" => null,
            ]],
            [[
                "cap" => 1,
                "excludeVehicleTypes" => [],
                "currentVehicles" => [],
                "vehicleType" => "v",
                "vehicleSize" => 0.5,
                "exception" => null,
            ]],
            [[
                "cap" => 1,
                "excludeVehicleTypes" => [],
                "currentVehicles" => [],
                "vehicleType" => "v",
                "vehicleSize" => 1.5,
                "exception" => NoCapacityException::class,
            ]],
            [[
                "cap" => 0,
                "excludeVehicleTypes" => [],
                "currentVehicles" => [],
                "vehicleType" => "v",
                "vehicleSize" => 1.0,
                "exception" => NoCapacityException::class,
            ]],
            [[
                "cap" => 1,
                "excludeVehicleTypes" => [],
                "currentVehicles" => [0.5],
                "vehicleType" => "v",
                "vehicleSize" => 0.5,
                "exception" => null,
            ]],
            [[
                "cap" => 1,
                "excludeVehicleTypes" => [],
                "currentVehicles" => [0.5],
                "vehicleType" => "v",
                "vehicleSize" => 1.0,
                "exception" => NoCapacityException::class,
            ]],
            [[
                "cap" => 2,
                "excludeVehicleTypes" => [],
                "currentVehicles" => [0.5],
                "vehicleType" => "v",
                "vehicleSize" => 1.0,
                "exception" => null,
            ]],
            [[
                "cap" => 1,
                "excludeVehicleTypes" => ["van"],
                "currentVehicles" => [],
                "vehicleType" => "van",
                "vehicleSize" => 0.5,
                "exception" => NoCapacityException::class,
            ]],
        ];
    }

    private function createVehicleStub(float $size, string $type): VehicleInterface
    {
        $vehicle = $this->createStub(VehicleInterface::class);
        $vehicle->method("getSize")->willReturn($size);
        $vehicle->method("getType")->willReturn($type);

        return $vehicle;
    }
}