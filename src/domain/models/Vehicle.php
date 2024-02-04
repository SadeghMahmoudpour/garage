<?php

namespace Temperworks\Codechallenge\domain\models;

class Vehicle
{
    public function __construct(private float $size, private string $type)
    {
    }

    public function getSize(): float
    {
        return $this->size;
    }

    public function getType(): string
    {
        return $this->type;
    }
}