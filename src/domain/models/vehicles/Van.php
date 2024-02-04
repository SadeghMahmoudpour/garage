<?php

namespace Temperworks\Codechallenge\domain\models\vehicles;

use Temperworks\Codechallenge\domain\models\Vehicle;

class Van extends Vehicle
{
    public const TYPE = "VAN";

    public const SIZE = 1.5;

    public function __construct()
    {
        parent::__construct(self::SIZE, self::TYPE);
    }
}