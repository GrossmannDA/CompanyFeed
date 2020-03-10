<?php

namespace App\Repository;

use App\Entity\FeedItemCategorie;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method FeedItemCategorie|null find($id, $lockMode = null, $lockVersion = null)
 * @method FeedItemCategorie|null findOneBy(array $criteria, array $orderBy = null)
 * @method FeedItemCategorie[]    findAll()
 * @method FeedItemCategorie[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FeedItemCategorieRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, FeedItemCategorie::class);
    }

    // /**
    //  * @return FeedItemCategorie[] Returns an array of FeedItemCategorie objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('f.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?FeedItemCategorie
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
