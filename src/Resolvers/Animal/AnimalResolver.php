<?php

namespace App\Resolvers\Animal;

use App\Entity\Animal;
use Overblog\GraphQLBundle\Resolver\TypeResolver;

class AnimalResolver
{
    private $typeResolver;

    public function __construct(TypeResolver $typeResolver)
    {
        $this->typeResolver = $typeResolver;
    }

    /**
     * @param  $animal
     * @return string|null
     * @throws \ReflectionException
     */
    public function resolveType(Animal $animal): ?string
    {
        return $this->typeResolver->resolve((new \ReflectionClass($animal))->getShortName());
    }
}
