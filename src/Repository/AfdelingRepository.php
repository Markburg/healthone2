<?php

namespace App\Repository;

use App\Entity\Afdeling;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Afdeling|null find($id, $lockMode = null, $lockVersion = null)
 * @method Afdeling|null findOneBy(array $criteria, array $orderBy = null)
 * @method Afdeling[]    findAll()
 * @method Afdeling[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AfdelingRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Afdeling::class);
    }

    // /**
    //  * @return Afdeling[] Returns an array of Afdeling objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Afdeling
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
