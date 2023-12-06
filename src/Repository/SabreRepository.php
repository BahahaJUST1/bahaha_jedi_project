<?php

namespace App\Repository;

use App\Entity\Sabre;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Sabre>
 *
 * @method Sabre|null find($id, $lockMode = null, $lockVersion = null)
 * @method Sabre|null findOneBy(array $criteria, array $orderBy = null)
 * @method Sabre[]    findAll()
 * @method Sabre[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SabreRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Sabre::class);
    }

//    /**
//     * @return Sabre[] Returns an array of Sabre objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('s.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Sabre
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
