<?php

namespace App\Repository;

use App\Entity\PostEmploi;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method PostEmploi|null find($id, $lockMode = null, $lockVersion = null)
 * @method PostEmploi|null findOneBy(array $criteria, array $orderBy = null)
 * @method PostEmploi[]    findAll()
 * @method PostEmploi[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PostEmploiRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PostEmploi::class);
    }

    // /**
    //  * @return PostEmploi[] Returns an array of PostEmploi objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?PostEmploi
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
