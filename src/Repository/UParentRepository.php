<?php

namespace App\Repository;

use App\Entity\UParent;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method UParent|null find($id, $lockMode = null, $lockVersion = null)
 * @method UParent|null findOneBy(array $criteria, array $orderBy = null)
 * @method UParent[]    findAll()
 * @method UParent[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UParentRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, UParent::class);
    }

    // /**
    //  * @return UParent[] Returns an array of UParent objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('u.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?UParent
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
