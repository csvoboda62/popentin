<?php

namespace App\Repository;

use App\Entity\PopImage;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<PopImage>
 *
 * @method PopImage|null find($id, $lockMode = null, $lockVersion = null)
 * @method PopImage|null findOneBy(array $criteria, array $orderBy = null)
 * @method PopImage[]    findAll()
 * @method PopImage[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PopImageRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PopImage::class);
    }

//    /**
//     * @return PopImage[] Returns an array of PopImage objects
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

//    public function findOneBySomeField($value): ?PopImage
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
