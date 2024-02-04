<?php

namespace unit\domain\services;

use PHPUnit\Framework\TestCase;
use Temperworks\Codechallenge\domain\exceptions\CouldNotParkVehicle;
use Temperworks\Codechallenge\domain\models\Floor;
use Temperworks\Codechallenge\domain\models\Parking;
use Temperworks\Codechallenge\domain\models\Vehicle;
use Temperworks\Codechallenge\domain\repositories\ParkingRepositoryInterface;
use Temperworks\Codechallenge\domain\services\ParkingService;

class ParkingServiceTest extends TestCase
{
    public function testCreateParking()
    {
        $parking = new Parking();
        $parkingRepository = $this->createParkingRepositoryStub($parking);
        $parkingService = new ParkingService($parkingRepository);

        $result = $parkingService->createParking($parking);

        self::assertInstanceOf(Parking::class, $result);
    }

    /**
     * @dataProvider provideTestParking
     */
    public function testCheckCapacity(array $testcase)
    {
        $parking = $this->createParking($testcase["floors"]);
        $vehicle = new Vehicle($testcase["vehicleSize"], $testcase["vehicleType"]);
        $parkingRepository = $this->createParkingRepositoryStub($parking);
        $parkingService = new ParkingService($parkingRepository);

        $result = $parkingService->checkCapacity($vehicle);

        self::assertEquals($testcase["result"], $result);
    }

    /**
     * @dataProvider provideTestParking
     */
    public function testParkVehicle(array $testcase)
    {
        $parking = $this->createParking($testcase["floors"]);
        $vehicle = new Vehicle($testcase["vehicleSize"], $testcase["vehicleType"]);
        $parkingRepository = $this->createParkingRepositoryStub($parking);
        $parkingService = new ParkingService($parkingRepository);

        if (!$testcase["result"]) {
            $this->expectException(CouldNotParkVehicle::class);
        } else {
            $this->expectNotToPerformAssertions();
        }
        $parkingService->parkVehicle($vehicle);
    }

    public function provideTestParking(): array
    {
        return [
            [[
                "floors" => [],
                "vehicleSize" => 1.0,
                "vehicleType" => "type",
                "result" => false,
            ]],
            [[
                "floors" => [
                    [
                        "floor" => new Floor(1.0, []),
                        "vehicles" => []
                    ],
                ],
                "vehicleSize" => 1.0,
                "vehicleType" => "type",
                "result" => true,
            ]],
            [[
                "floors" => [
                    [
                        "floor" => new Floor(1.0, ["type"]),
                        "vehicles" => []
                    ],
                ],
                "vehicleSize" => 2.0,
                "vehicleType" => "type",
                "result" => false,
            ]],
            [[
                "floors" => [
                    [
                        "floor" => new Floor(2.0, []),
                        "vehicles" => []
                    ],
                ],
                "vehicleSize" => 1.0,
                "vehicleType" => "type",
                "result" => true,
            ]],
            [[
                "floors" => [
                    [
                        "floor" => new Floor(2.0, ["type"]),
                        "vehicles" => []
                    ],
                ],
                "vehicleSize" => 1.0,
                "vehicleType" => "type",
                "result" => false,
            ]],
            [[
                "floors" => [
                    [
                        "floor" => new Floor(2.0, []),
                        "vehicles" => [2]
                    ],
                ],
                "vehicleSize" => 1.0,
                "vehicleType" => "type",
                "result" => false,
            ]],
            [[
                "floors" => [
                    [
                        "floor" => new Floor(2.0, []),
                        "vehicles" => [1.0]
                    ],
                ],
                "vehicleSize" => 1.0,
                "vehicleType" => "type",
                "result" => true,
            ]],
            [[
                "floors" => [
                    [
                        "floor" => new Floor(2.0, []),
                        "vehicles" => [1.0]
                    ],
                    [
                        "floor" => new Floor(2.0, ["type"]),
                        "vehicles" => []
                    ],
                ],
                "vehicleSize" => 1.5,
                "vehicleType" => "type",
                "result" => false,
            ]],
            [[
                "floors" => [
                    [
                        "floor" => new Floor(2.0, []),
                        "vehicles" => [2.0]
                    ],
                    [
                        "floor" => new Floor(2.0, []),
                        "vehicles" => []
                    ],
                ],
                "vehicleSize" => 1.5,
                "vehicleType" => "type",
                "result" => true,
            ]],
        ];
    }

    private function createParking($floorsData): Parking
    {
        $floors = [];
        foreach ($floorsData as $floorData) {
            /** @var Floor $floor */
            $floor = $floorData["floor"];
            foreach ($floorData["vehicles"] as $vehicleSize) {
                $floor->parkVehicle(new Vehicle($vehicleSize, "t"));
            }
            $floors[] = $floor;
        }

        return new Parking($floors);
    }

    private function createParkingRepositoryStub(Parking $parking): ParkingRepositoryInterface
    {
        $repo = $this->createStub(ParkingRepositoryInterface::class);
        $repo->method("create")->willReturn($parking);
        $repo->method("find")->willReturn($parking);
        $repo->method("save");

        return $repo;
    }
}