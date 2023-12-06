<?php

namespace App\Repository;

use App\Entity\Padawan;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Padawan>
 *
 * @method Padawan|null find($id, $lockMode = null, $lockVersion = null)
 * @method Padawan|null findOneBy(array $criteria, array $orderBy = null)
 * @method Padawan[]    findAll()
 * @method Padawan[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PadawanRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Padawan::class);
    }

//    /**
//     * @return Padawan[] Returns an array of Padawan objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('p.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Padawan
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
