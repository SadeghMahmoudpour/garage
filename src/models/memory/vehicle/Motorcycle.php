<?php

namespace Temperworks\Codechallenge\models\memory\vehicle;

use Temperworks\Codechallenge\models\memory\Vehicle;

class Motorcycle extends Vehicle
{
    public const TYPE = "MOTORCYCLE";

    public const SIZE = 0.5;

    public function __construct()
    {
        parent::__construct(self::SIZE, self::TYPE);
    }
}
