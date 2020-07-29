<?php

namespace App\Vehicle\Domain\Input;

use App\Entity\Vehicle;

class CarInput extends Vehicle
{
    protected $id;
    protected $seatsNumber;

    public function __construct(string $id, string $manufacturer, string $model, int $seatsNumber)
    {
        parent::__construct($id, $manufacturer, $model, 'car');

        $this->seatsNumber = $seatsNumber;
    }

    public function getSeatsNumber(): int
    {
        return $this->seatsNumber;
    }
}
