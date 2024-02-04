<?php

namespace Tests\Builders;

use Temperworks\Codechallenge\domain\models\Floor;
use Temperworks\Codechallenge\domain\models\Parking;

class ParkingBuilder
{
    private array $floors = [];

    public static function create(): self
    {
        return new static();
    }

    public function withFloor(Floor $floor): self
    {
        $this->floors[] = $floor;

        return $this;
    }

    public function build(): Parking
    {
        return new Parking($this->floors);
    }
}