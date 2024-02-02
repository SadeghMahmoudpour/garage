<?php

namespace Temperworks\Codechallenge\models;

interface VehicleInterface
{
    public function getSize(): float;

    public function getType(): string;
}