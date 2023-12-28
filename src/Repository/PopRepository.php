<?php

namespace App\Repository;

use App\Entity\Pop;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Pop>
 *
 * @method Pop|null find($id, $lockMode = null, $lockVersion = null)
 * @method Pop|null findOneBy(array $criteria, array $orderBy = null)
 * @method Pop[]    findAll()
 * @method Pop[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PopRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Pop::class);
    }

    /**
     * @return Pop[] Returns an array of Pop objects
     */
    public function findPopBySearch(string $value): array
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.name LIKE :name')
            ->setParameter('name', '%'.$value.'%')
            ->orderBy('p.id', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }

//    public function findOneBySomeField($value): ?Pop
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
