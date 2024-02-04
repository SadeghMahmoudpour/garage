<?php

namespace Tests\Builders;

use Temperworks\Codechallenge\domain\models\Floor;

class FloorBuilder
{
    private float $capacity = 0;

    private array $excludedVehicleTypes = [];

    public static function create(): self
    {
        return new static();
    }

    public function withCapacity(float $capacity): self
    {
        $this->capacity = $capacity;

        return $this;
    }

    public function withExcludedVehicleTypes(array $types)
    {
        $this->excludedVehicleTypes = $types;

        return $this;
    }

    public function build(): Floor
    {
        return new Floor($this->capacity, $this->excludedVehicleTypes);
    }
}