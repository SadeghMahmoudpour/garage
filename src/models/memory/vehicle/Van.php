<?php

namespace Temperworks\Codechallenge\models\memory\vehicle;

use Temperworks\Codechallenge\models\memory\Vehicle;

class Van extends Vehicle
{
    public const TYPE = "VAN";

    public const SIZE = 1.5;

    public function __construct()
    {
        parent::__construct(self::SIZE, self::TYPE);
    }
}