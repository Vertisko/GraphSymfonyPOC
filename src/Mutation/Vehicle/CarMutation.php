<?php

namespace App\Mutation\Vehicle;

use App\Common\Domain\ValidationException;
use App\Repository\VehicleRepository;
use App\Factory\VehicleFactory;
use App\Entity\Vehicle;
use Overblog\GraphQLBundle\Definition\Argument;
use Overblog\GraphQLBundle\Definition\Resolver\AliasedInterface;
use Overblog\GraphQLBundle\Definition\Resolver\MutationInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class CarMutation implements MutationInterface, AliasedInterface
{
    private $vehicleRepository;
    private $validator;

    public function __construct(VehicleRepository $vehicleRepository, ValidatorInterface $validator)
    {
        $this->vehicleRepository = $vehicleRepository;
        $this->validator = $validator;
    }

    /**
     * @throws ValidationException
     */
    public function createCar(Argument $argument): Vehicle
    {
        $carInput = VehicleFactory::createCarInput($argument);

        $constraintViolations = $this->validator->validate($carInput, null, ['create']);

        if ($constraintViolations->count()) {
            throw new ValidationException($constraintViolations, 'Car mutation is invalid');
        }

        $vehicle = VehicleFactory::createCar($carInput);
        return $this->vehicleRepository->save($vehicle);
    }

    /**
     * @throws ValidationException
     */
    public function updateCar(Argument $argument): Vehicle
    {
        $carInput = VehicleFactory::createCarInput($argument);

        $constraintViolations = $this->validator->validate($carInput, null, ['update']);

        if ($constraintViolations->count()) {
            throw new ValidationException($constraintViolations, 'Car mutation is invalid');
        }

        $car = $this->vehicleRepository->find($carInput->getId());

        $car
            ->setManufacturer($carInput->getManufacturer())
            ->setModel($carInput->getModel())
        ;

        return $this->vehicleRepository->save($car);
    }

    public static function getAliases(): array
    {
        return [
            'resolve' => 'CarMutation',
        ];
    }
}
