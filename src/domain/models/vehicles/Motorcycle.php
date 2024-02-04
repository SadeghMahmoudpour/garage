<?php

namespace Temperworks\Codechallenge\domain\models\vehicles;

use Temperworks\Codechallenge\domain\models\Vehicle;

class Motorcycle extends Vehicle
{
    public const TYPE = "MOTORCYCLE";

    public const SIZE = 0.5;

    public function __construct()
    {
        parent::__construct(self::SIZE, self::TYPE);
    }
}
