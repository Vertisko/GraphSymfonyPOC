<?php

namespace App\Resolvers\Person;

use App\Entity\Person;
use App\Query\PersonsQuery;
use App\Repository\PersonRepository;
use Overblog\GraphQLBundle\Definition\Argument;
use Overblog\GraphQLBundle\Definition\Resolver\AliasedInterface;
use Overblog\GraphQLBundle\Definition\Resolver\ResolverInterface;

class PersonsResolver implements ResolverInterface, AliasedInterface
{
    private $personRepository;

    public function __construct(PersonRepository $personRepository)
    {
        $this->personRepository = $personRepository;
    }

    /**
     * @param Argument $argument
     * @return Person[]
     */
    public function resolve(Argument $argument): array
    {
        $query = PersonsQuery::createFromArgument($argument);

        $persons = $this->personRepository->findAll();

        if($query->hasLastElements()){
            $elems = $query->getLastElements();
            return array_slice($persons, (int) "-$elems");
        }


        if($query->hasFirstElements()){
            $elems = $query->getLastElements();
            return array_slice($persons, 0, $elems);
        }

        return $persons;
    }

    public static function getAliases(): array
    {
        return [
            'resolve' => 'Persons',
        ];
    }
}
