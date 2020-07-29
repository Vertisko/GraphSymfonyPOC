<?php

namespace App\Mutation\Vehicle;

use App\Common\App\Transformer\AppGlobalId;
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
            throw new UserError(sprintf(
                '%s [%s] not found',
                AppGlobalId::getTypeFromGlobalId($globalId),
                $globalId
            ));
        }

        $this->vehicleRepository->delete($vehicle);

        return $globalId;
    }

    public static function getAliases(): array
    {
        return [
            'resolve' => 'VehicleMutation',
        ];
    }
}
