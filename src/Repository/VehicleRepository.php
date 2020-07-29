<?php

namespace App\Repository;

use App\Entity\Person;
use App\Entity\Vehicle;
use App\Query\VehiclesQuery;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\Query\Expr\Join;

/**
 * @method Vehicle|null find($id, $lockMode = null, $lockVersion = null)
 * @method Vehicle|null findOneBy(array $criteria, array $orderBy = null)
 * @method Vehicle[]    findAll()
 * @method Vehicle[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VehicleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Vehicle::class);
    }


    public function findByPerson(Person $person): array
    {
        $qb = $this->createQueryBuilder('v');

        $qb
            ->innerJoin(Person::class, 'p')
            ->innerJoin('p.vehicles', 'phv', Join::WITH, 'phv.id = v.id')
            ->andWhere(
                $qb->expr()->eq(
                    'p.id',
                    $qb->expr()->literal($person->getId())
                )
            );

        return $qb->getQuery()->getResult();
    }

    public function findEverything(VehiclesQuery $query): array
    {
        $qb = $this->createQueryBuilder('v');

        if ($query->hasPersonId()) {
            $qb
                ->innerJoin(Person::class, 'p')
                ->innerJoin('p.vehicles', 'phv', Join::WITH, 'phv.id = v.id')
                ->andWhere(
                    $qb->expr()->eq(
                        'p.id',
                        $qb->expr()->literal($query->getPersonId())
                    )
                )
            ;
        }

        if ($query->hasVehicleId()) {
            $qb->andWhere(
                $qb->expr()->eq(
                    'v.id',
                    $qb->expr()->literal($query->getVehicleId())
                )
            );
        }

        if ($query->hasAfter()) {
            $qb->andWhere(
                $qb->expr()->gt(
                    'v.id',
                    $qb->expr()->literal($query->getAfter())
                )
            );
        }

        if ($query->hasOffset()) {
            $qb->setFirstResult($query->getOffset());
        }

        if ($query->hasLimit()) {
            $qb->setMaxResults($query->getLimit());
        }

        $qb->orderBy('v.id', 'ASC');

        return $qb->getQuery()->getResult();
    }

    /**
     * @param string $id
     * @return Vehicle|null
     * @throws NonUniqueResultException
     */
    public function findById($id): ?Vehicle
    {
        $qb = $this->createQueryBuilder('v');

        $qb->andWhere(
            $qb->expr()->eq(
                'v.id',
                $qb->expr()->literal($id)
            )
        );

        return $qb->getQuery()->getOneOrNullResult();
    }

    /**
     * @param Vehicle $vehicle
     * @return Vehicle
     */
    public function save(Vehicle $vehicle): Vehicle
    {
        $this->getEntityManager()->persist($vehicle);
        $this->getEntityManager()->flush();

        return $vehicle;
    }

    /**
     * @param Vehicle $vehicle
     */
    public function delete(Vehicle $vehicle): void
    {
        $this->getEntityManager()->remove($vehicle);
        $this->getEntityManager()->flush();
    }

}
