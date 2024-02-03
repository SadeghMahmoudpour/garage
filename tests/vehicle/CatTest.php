<?php

namespace vehicle;

use PHPUnit\Framework\TestCase;
use Temperworks\Codechallenge\models\memory\vehicle\Car;

class CatTest extends TestCase
{
    public function testGetType()
    {
        $car = new Car();
        self::assertEquals(Car::TYPE, $car->getType());
    }

    public function testGetSize()
    {
        $car = new Car();
        self::assertEquals(Car::SIZE, $car->getSize());
    }
}