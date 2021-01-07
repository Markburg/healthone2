<?php

namespace App\Repository;

use App\Entity\Medicijn;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Medicijn|null find($id, $lockMode = null, $lockVersion = null)
 * @method Medicijn|null findOneBy(array $criteria, array $orderBy = null)
 * @method Medicijn[]    findAll()
 * @method Medicijn[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MedicijnRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Medicijn::class);
    }

    // /**
    //  * @return Medicijn[] Returns an array of Medicijn objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Medicijn
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
