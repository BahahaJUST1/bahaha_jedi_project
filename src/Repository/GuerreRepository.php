<?php

namespace App\Repository;

use App\Entity\Guerre;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Guerre>
 *
 * @method Guerre|null find($id, $lockMode = null, $lockVersion = null)
 * @method Guerre|null findOneBy(array $criteria, array $orderBy = null)
 * @method Guerre[]    findAll()
 * @method Guerre[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GuerreRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Guerre::class);
    }

//    /**
//     * @return Guerre[] Returns an array of Guerre objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('g')
//            ->andWhere('g.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('g.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Guerre
//    {
//        return $this->createQueryBuilder('g')
//            ->andWhere('g.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
