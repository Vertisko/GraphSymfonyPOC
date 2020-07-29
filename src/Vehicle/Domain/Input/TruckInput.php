<?php

namespace App\Vehicle\Domain\Input;

use App\Entity\Vehicle;

class TruckInput extends Vehicle
{
    protected $id;
    protected $maximumLoad;

    public function __construct(string $id, string $manufacturer, string $model, string $maximumLoad)
    {
        parent::__construct($id, $manufacturer, $model, 'truck');

        $this->maximumLoad = $maximumLoad;
    }

    public function getMaximumLoad(): int
    {
        return $this->maximumLoad;
    }
}
