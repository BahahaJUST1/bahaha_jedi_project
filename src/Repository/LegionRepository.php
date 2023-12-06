<?php

namespace App\Repository;

use App\Entity\Legion;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Legion>
 *
 * @method Legion|null find($id, $lockMode = null, $lockVersion = null)
 * @method Legion|null findOneBy(array $criteria, array $orderBy = null)
 * @method Legion[]    findAll()
 * @method Legion[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LegionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Legion::class);
    }

//    /**
//     * @return Legion[] Returns an array of Legion objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('l')
//            ->andWhere('l.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('l.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Legion
//    {
//        return $this->createQueryBuilder('l')
//            ->andWhere('l.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
