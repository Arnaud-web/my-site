<?php

namespace App\Repository;

use App\Entity\Message;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Message|null find($id, $lockMode = null, $lockVersion = null)
 * @method Message|null findOneBy(array $criteria, array $orderBy = null)
 * @method Message[]    findAll()
 * @method Message[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MessageRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Message::class);
    }

     /**
      * @return Message[] Returns an array of Message objects
      */

    public function findMessages($param)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.idm = :idm')
            ->orWhere('m.idm = :idm1')
//            ->andWhere('m.userReceved = :her')
//            ->andWhere('m.userSend = :me')
            ->setParameter('idm', $param ['idm'])
            ->setParameter('idm1', $param ['idm1'])
            ->orderBy('m.id', 'DESC')
//            ->setMaxResults(5)
            ->getQuery()
            ->getResult()
        ;
    }


    /*
    public function findOneBySomeField($value): ?Message
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
