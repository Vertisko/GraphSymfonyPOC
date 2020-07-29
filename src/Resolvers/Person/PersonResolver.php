<?php

namespace App\Resolvers\Person;

use App\Entity\Person;
use App\Repository\PersonRepository;
use Doctrine\ORM\NonUniqueResultException;
use Overblog\GraphQLBundle\Definition\Resolver\AliasedInterface;
use Overblog\GraphQLBundle\Definition\Resolver\ResolverInterface;

class PersonResolver implements ResolverInterface, AliasedInterface
{
    private $personRepository;

    public function __construct(PersonRepository $personRepository)
    {
        $this->personRepository = $personRepository;
    }

    /**
     * @param string $id
     * @return Person|null
     * @throws NonUniqueResultException
     */
    public function resolve(string $id): ?Person
    {
        return $this->personRepository->findById($id);
    }

    /**
     * @return string[]
     */
    public static function getAliases(): array
    {
        return [
            'resolve' => 'Person',
        ];
    }
}
