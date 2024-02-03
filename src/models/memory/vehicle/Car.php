<?php

namespace Temperworks\Codechallenge\models\memory\vehicle;

use Temperworks\Codechallenge\models\memory\Vehicle;

class Car extends Vehicle
{
    public const TYPE = "CAR";

    public const SIZE = 1;

    public function __construct()
    {
        parent::__construct(self::SIZE, self::TYPE);
    }
}