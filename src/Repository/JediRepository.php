<?php

namespace App\Repository;

use App\Entity\Jedi;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Jedi>
 *
 * @method Jedi|null find($id, $lockMode = null, $lockVersion = null)
 * @method Jedi|null findOneBy(array $criteria, array $orderBy = null)
 * @method Jedi[]    findAll()
 * @method Jedi[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class JediRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Jedi::class);
    }

//    /**
//     * @return Jedi[] Returns an array of Jedi objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('j')
//            ->andWhere('j.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('j.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Jedi
//    {
//        return $this->createQueryBuilder('j')
//            ->andWhere('j.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
