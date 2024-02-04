<?php

namespace Temperworks\Codechallenge\domain\models\vehicles;


use Temperworks\Codechallenge\domain\models\Vehicle;

class Car extends Vehicle
{
    public const TYPE = "CAR";

    public const SIZE = 1;

    public function __construct()
    {
        parent::__construct(self::SIZE, self::TYPE);
    }
}