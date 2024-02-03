<?php

use PHPUnit\Framework\TestCase;
use Temperworks\Codechallenge\exceptions\NoCapacityException;
use Temperworks\Codechallenge\models\FloorInterface;
use Temperworks\Codechallenge\models\memory\Parking;
use Temperworks\Codechallenge\models\VehicleInterface;

class ParkingTest extends TestCase
{
    /**
     * @dataProvider provideTestDataForDoesAcceptVehicle
     */
    public function testDoesAcceptVehicle(array $testCase)
    {
        $floors = [];
        foreach ($testCase["floors"] as $floorData) {
            $floors[] = $this->createFloor($floorData["acceptVehicle"], $floorData["parkVehicle"]);
        }
        $parking = new Parking($floors);

        $vehicle = $this->createVehicleStub($testCase["vehicleSize"], $testCase["vehicleType"]);

        $result = $parking->doesAcceptVehicle($vehicle);
        self::assertEquals($testCase["result"], $result);
    }

    public function provideTestDataForDoesAcceptVehicle()
    {
        return [
            [[
                "floors" => [
                    [
                        "acceptVehicle" => true,
                        "parkVehicle" => null,
                    ],
                ],
                "vehicleType" => "car",
                "vehicleSize" => 1.0,
                "result" => true,
            ]],
            [[
                "floors" => [
                    [
                        "acceptVehicle" => false,
                        "parkVehicle" => null,
                    ],
                ],
                "vehicleType" => "car",
                "vehicleSize" => 1.0,
                "result" => false,
            ]],
            [[
                "floors" => [
                    [
                        "acceptVehicle" => false,
                        "parkVehicle" => null,
                    ],
                    [
                        "acceptVehicle" => true,
                        "parkVehicle" => null,
                    ],
                    [
                        "acceptVehicle" => false,
                        "parkVehicle" => null,
                    ],
                ],
                "vehicleType" => "car",
                "vehicleSize" => 1.0,
                "result" => true,
            ]],
            [[
                "floors" => [],
                "vehicleType" => "car",
                "vehicleSize" => 1.0,
                "result" => false,
            ]],
        ];
    }

    /**
     * @dataProvider provideTestDataParkVehicle
     */
    public function testParkVehicle(array $testCase)
    {
        $floors = [];
        foreach ($testCase["floors"] as $floorData) {
            $floors[] = $this->createFloor($floorData["acceptVehicle"], $floorData["parkVehicle"]);
        }
        $parking = new Parking($floors);

        $vehicle = $this->createVehicleStub($testCase["vehicleSize"], $testCase["vehicleType"]);

        if($testCase["exception"]) {
            $this->expectException($testCase["exception"]);
        } else {
            $this->expectNotToPerformAssertions();
        }
        $parking->parkVehicle($vehicle);
    }

    public function provideTestDataParkVehicle()
    {
        return [
            [[
                "floors" => [
                    [
                        "acceptVehicle" => true,
                        "parkVehicle" => null,
                    ],
                ],
                "vehicleType" => "car",
                "vehicleSize" => 1.0,
                "exception" => null,
            ]],
            [[
                "floors" => [
                    [
                        "acceptVehicle" => false,
                        "parkVehicle" => null,
                    ],
                ],
                "vehicleType" => "car",
                "vehicleSize" => 1.0,
                "exception" => NoCapacityException::class,
            ]],
            [[
                "floors" => [
                    [
                        "acceptVehicle" => false,
                        "parkVehicle" => null,
                    ],
                    [
                        "acceptVehicle" => true,
                        "parkVehicle" => null,
                    ],
                    [
                        "acceptVehicle" => false,
                        "parkVehicle" => null,
                    ],
                ],
                "vehicleType" => "car",
                "vehicleSize" => 1.0,
                "exception" => null,
            ]],
            [[
                "floors" => [],
                "vehicleType" => "car",
                "vehicleSize" => 1.0,
                "exception" => NoCapacityException::class,
            ]],
            [[
                "floors" => [
                    [
                        "acceptVehicle" => true,
                        "parkVehicle" => new NoCapacityException(),
                    ],
                ],
                "vehicleType" => "car",
                "vehicleSize" => 1.0,
                "exception" => NoCapacityException::class,
            ]],
        ];
    }

    private function createFloor(bool $doesAccept, ?\Exception $parkVehicleException): FloorInterface
    {
        $floor = $this->createStub(FloorInterface::class);
        $floor->method("doesAcceptVehicle")->willReturn($doesAccept);
        if($parkVehicleException) {
            $floor->method("parkVehicle")->willThrowException($parkVehicleException);
        } else {
            $floor->method("parkVehicle");
        }

        return $floor;
    }

    private function createVehicleStub(float $size, string $type): VehicleInterface
    {
        $vehicle = $this->createStub(VehicleInterface::class);
        $vehicle->method("getSize")->willReturn($size);
        $vehicle->method("getType")->willReturn($type);

        return $vehicle;
    }
}