<?php

namespace App\Resolvers\Vehicle;

use App\Entity\Vehicle;
use App\Repository\VehicleRepository;
use Doctrine\ORM\NonUniqueResultException;
use Overblog\GraphQLBundle\Definition\Resolver\AliasedInterface;
use Overblog\GraphQLBundle\Definition\Resolver\ResolverInterface;
use Overblog\GraphQLBundle\Resolver\TypeResolver;

class VehicleResolver implements ResolverInterface, AliasedInterface
{
    private $typeResolver;
    private $vehicleRepository;

    public function __construct(TypeResolver $typeResolver, VehicleRepository $vehicleRepository)
    {
        $this->typeResolver = $typeResolver;
        $this->vehicleRepository = $vehicleRepository;
    }

    /**
     * @param Vehicle $vehicle
     * @return string|null
     * @throws \ReflectionException
     */
    public function resolveType(Vehicle $vehicle): ?string
    {
        return $this->typeResolver->resolve((new \ReflectionClass($vehicle))->getShortName());
    }

    /**
     * @param string $id
     * @return Vehicle|null
     * @throws NonUniqueResultException
     */
    public function resolve(string $id): ?Vehicle
    {
        return $this->vehicleRepository->findById($id);
    }

    /**
     * @return string[]
     */
    public static function getAliases(): array
    {
        return [
            'resolve' => 'Vehicle',
        ];
    }
}
