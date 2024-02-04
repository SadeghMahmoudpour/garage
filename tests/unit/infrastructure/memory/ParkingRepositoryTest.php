<?php

namespace unit\infrastructure\memory;

use PHPUnit\Framework\TestCase;
use Temperworks\Codechallenge\domain\models\vehicles\Car;
use Temperworks\Codechallenge\domain\models\vehicles\Van;
use Temperworks\Codechallenge\infrastructure\repository\memory\ParkingRepository;
use Tests\Builders\FloorBuilder;
use Tests\Builders\ParkingBuilder;
use function PHPUnit\Framework\assertEquals;

class ParkingRepositoryTest extends TestCase
{
    public function testCreate()
    {
        $parking = ParkingBuilder::create()->withFloor(
            FloorBuilder::create()->withCapacity(2)->build(),
        )->withFloor(
            FloorBuilder::create()->withCapacity(1)->withExcludedVehicleTypes([Van::TYPE])->build()
        )->withFloor(
            FloorBuilder::create()->withCapacity(3)->withExcludedVehicleTypes([Van::TYPE])->build()
        )->build();

        $parkingRepository = new ParkingRepository();

        $parking = $parkingRepository->create($parking);

        assertEquals($parking, $parkingRepository->find());
    }

    public function testFindNotFound()
    {
        $parkingRepository = new ParkingRepository();

        $parking = $parkingRepository->find();

        self::assertNull($parking);
    }

    public function testSave()
    {
        $parking = ParkingBuilder::create()->withFloor(
            FloorBuilder::create()->withCapacity(2)->build(),
        )->withFloor(
            FloorBuilder::create()->withCapacity(1)->withExcludedVehicleTypes([Van::TYPE])->build()
        )->withFloor(
            FloorBuilder::create()->withCapacity(3)->withExcludedVehicleTypes([Van::TYPE])->build()
        )->build();

        $parkingRepository = new ParkingRepository();

        $parking = $parkingRepository->create($parking);
        $car = new Car();
        $parking->parkVehicle($car);
        $parkingRepository->save($parking);

        assertEquals($parking, $parkingRepository->find());
    }
}