<?php

namespace App\Query;

use App\Common\App\Transformer\AppGlobalId;
use Overblog\GraphQLBundle\Definition\Argument;

class PersonsQuery
{
    private $personId;

    /**
     * @var int|null
     */
    private $lastElements;
    /**
     * @var int|null
     */
    private $firstElements;

    public function __construct(string $personId = null, int $lastElements = null, int $firstElements = null)
    {
        $this->personId = $personId;
        $this->lastElements = $lastElements;
        $this->firstElements = $firstElements;
    }

    public static function createFromArgument(Argument $argument)
    {
        return new self(
            ($argument->offsetGet('id'))? AppGlobalId::getIdFromGlobalId($argument->offsetGet('id')) : null,
            ($argument->offsetGet('last'))? (int) $argument->offsetGet('last') : null,
            ($argument->offsetGet('first'))? (int) AppGlobalId::getIdFromGlobalId($argument->offsetGet('first')) : null
        );

    }

    public function getPersonId(): ?string
    {
        return $this->personId;
    }

    public function hasPersonId(): bool
    {
        return $this->personId !== null;
    }

    /**
     * @return int|null
     */
    public function getLastElements(): ?int
    {
        return $this->lastElements;
    }

    /**
     * @return bool
     */
    public function hasLastElements(): bool
    {
        return $this->lastElements !== null;
    }

    /**
     * @return int|null
     */
    public function getFirstElements(): ?int
    {
        return $this->firstElements;
    }

    /**
     * @return bool
     */
    public function hasFirstElements(): bool
    {
        return $this->firstElements !== null;
    }

}
