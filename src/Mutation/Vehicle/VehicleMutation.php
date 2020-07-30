<?php

namespace App\Mutation\Vehicle;

use App\Common\App\Transformer\AppGlobalId;
use App\Exceptions\NonExistingCarException;
use App\Repository\VehicleRepository;
use GraphQL\Error\UserError;
use Overblog\GraphQLBundle\Definition\Resolver\AliasedInterface;
use Overblog\GraphQLBundle\Definition\Resolver\MutationInterface;

class VehicleMutation implements MutationInterface, AliasedInterface
{
    private $vehicleRepository;

    public function __construct(VehicleRepository $vehicleRepository)
    {
        $this->vehicleRepository = $vehicleRepository;
    }

    public function deleteVehicle(string $globalId): string
    {
        $id = AppGlobalId::getIdFromGlobalId($globalId);

        if (!$vehicle = $this->vehicleRepository->find($id)) {
            throw new NonExistingCarException();
        }

        $this->vehicleRepository->delete($vehicle);

        return $globalId;
    }

    public static function getAliases(): array
    {
        return [
            'deleteVehicle' => 'delete_vehicle_mutation',
        ];
    }
}
