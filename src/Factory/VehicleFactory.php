<?php

namespace App\Factory;

use App\Common\App\Transformer\AppGlobalId;
use App\Entity\Vehicle;
use App\Vehicle\Domain\Input\CarInput;
use App\Vehicle\Domain\Input\TruckInput;
use Overblog\GraphQLBundle\Definition\Argument;

class VehicleFactory
{
    public static function createCarInput(Argument $argument): CarInput
    {
        $input = $argument->offsetGet('input');

        return new CarInput(
            AppGlobalId::getIdFromGlobalId($input['id']),
            $input['manufacturer'],
            $input['model'],
            $input['seats_number']
        );
    }

    public static function createCar(CarInput $input): Vehicle
    {
        return new Vehicle(
            $input->getId(),
            $input->getManufacturer(),
            $input->getModel(),
            'car'
        );
    }

    public static function createTruck(TruckInput $input): Vehicle
    {
        return new Vehicle(
            $input->getId(),
            $input->getManufacturer(),
            $input->getModel(),
            'car'
        );
    }

    public static function createTruckInput(Argument $argument): TruckInput
    {
        $input = $argument->offsetGet('input');

        return new TruckInput(
            AppGlobalId::getIdFromGlobalId($input['id']),
            $input['manufacturer'],
            $input['model'],
            $input['maximum_load']
        );
    }
}
