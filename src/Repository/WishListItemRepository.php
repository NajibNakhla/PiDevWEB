<?php

namespace App\Repository;

use App\Entity\Wishlistitem;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Wishlistitem>
 *
 * @method Wishlistitem|null find($id, $lockMode = null, $lockVersion = null)
 * @method Wishlistitem|null findOneBy(array $criteria, array $orderBy = null)
 * @method Wishlistitem[]    findAll()
 * @method Wishlistitem[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class WishListItemRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Wishlistitem::class);
    }

//    /**
//     * @return Wishlistitem[] Returns an array of Wishlistitem objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('w')
//            ->andWhere('w.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('w.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Wishlistitem
//    {
//        return $this->createQueryBuilder('w')
//            ->andWhere('w.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
