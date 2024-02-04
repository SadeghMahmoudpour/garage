<?php

namespace Temperworks\Codechallenge\application\usecase\createParking;

class CreateParking
{
    public function __construct(private array $capacities)
    {
    }

    public function getCapacities(): array
    {
        return $this->capacities;
    }
}