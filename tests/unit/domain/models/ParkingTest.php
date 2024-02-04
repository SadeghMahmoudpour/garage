<?php

namespace unit\domain\models;

use PHPUnit\Framework\TestCase;
use Temperworks\Codechallenge\domain\exceptions\CouldNotParkVehicle;
use Temperworks\Codechallenge\domain\models\Floor;
use Temperworks\Codechallenge\domain\models\Parking;
use Temperworks\Codechallenge\domain\models\Vehicle;

class ParkingTest extends TestCase
{
    /**
     * @dataProvider provideTestDataForDoesAcceptVehicle
     */
    public function testDoesAcceptVehicle(array $testCase)
    {
        $floors = [];
        foreach ($testCase["floors"] as $floorData) {
            $floors[] = $this->createFloorStub($floorData["acceptVehicle"], $floorData["parkVehicle"]);
        }
        $parking = new Parking($floors);

        $vehicle = new Vehicle($testCase["vehicleSize"], $testCase["vehicleType"]);

        $result = $parking->doesAcceptVehicle($vehicle);
        self::assertEquals($testCase["result"], $result);
    }

    public function provideTestDataForDoesAcceptVehicle(): array
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
            $floors[] = $this->createFloorStub($floorData["acceptVehicle"], $floorData["parkVehicle"]);
        }
        $parking = new Parking($floors);

        $vehicle = new Vehicle($testCase["vehicleSize"], $testCase["vehicleType"]);

        if ($testCase["exception"]) {
            $this->expectException($testCase["exception"]);
        } else {
            $this->expectNotToPerformAssertions();
        }
        $parking->parkVehicle($vehicle);
    }

    public function provideTestDataParkVehicle(): array
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
                "exception" => CouldNotParkVehicle::class,
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
                "exception" => CouldNotParkVehicle::class,
            ]],
            [[
                "floors" => [
                    [
                        "acceptVehicle" => true,
                        "parkVehicle" => CouldNotParkVehicle::becauseNoFloorAcceptsVehicle(),
                    ],
                ],
                "vehicleType" => "car",
                "vehicleSize" => 1.0,
                "exception" => CouldNotParkVehicle::class,
            ]],
        ];
    }

    private function createFloorStub(bool $doesAccept, ?\Exception $parkVehicleException): Floor
    {
        $floor = $this->createStub(Floor::class);
        $floor->method("doesAcceptVehicle")->willReturn($doesAccept);
        if ($parkVehicleException) {
            $floor->method("parkVehicle")->willThrowException($parkVehicleException);
        } else {
            $floor->method("parkVehicle");
        }

        return $floor;
    }
}