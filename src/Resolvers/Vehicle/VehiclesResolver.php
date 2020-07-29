<?php

namespace App\Resolvers\Vehicle;

use App\Entity\Person;
use App\Query\VehiclesQuery;
use App\Repository\VehicleRepository;
use Overblog\GraphQLBundle\Definition\Argument;
use Overblog\GraphQLBundle\Definition\Resolver\AliasedInterface;
use Overblog\GraphQLBundle\Definition\Resolver\ResolverInterface;
use Overblog\GraphQLBundle\Relay\Connection\Output\Connection;
use Overblog\GraphQLBundle\Relay\Connection\Paginator;

class VehiclesResolver implements ResolverInterface, AliasedInterface
{
    private $vehicleRepository;

    public function __construct(VehicleRepository $vehicleRepository)
    {
        $this->vehicleRepository = $vehicleRepository;
    }

    public function resolve(Argument $argument): Connection
    {
        $query = VehiclesQuery::createFromArgument($argument);

        $paginator = new Paginator(function ($offset, $limit) use ($query) {
            if ($offset !== null && $limit !== null) {
                $query
                    ->setLimit($limit)
                    ->setOffset($offset)
                ;
            }

            return $this->vehicleRepository->findEverything($query);
        });

        return $paginator->forward(
            new Argument([
                'first' => $argument->offsetGet('first'),
            ])
        );
    }

    public function resolveByPerson(Person $person, string $id = null): ?array
    {
        $query = new VehiclesQuery($person->getId(), $id);

        return $this->vehicleRepository->findEverything($query);
    }

    public static function getAliases(): array
    {
        return [
            'resolve' => 'Vehicles',
        ];
    }
}
