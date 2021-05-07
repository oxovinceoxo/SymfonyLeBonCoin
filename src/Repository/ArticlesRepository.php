<?php

namespace App\Repository;

use App\Entity\Articles;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Articles|null find($id, $lockMode = null, $lockVersion = null)
 * @method Articles|null findOneBy(array $criteria, array $orderBy = null)
 * @method Articles[]    findAll()
 * @method Articles[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */



class ArticlesRepository extends ServiceEntityRepository
{
    public function rechercheParametre($prix, $cat, $region){
        $query = $this->createQueryBuilder('a')
            ->orderBy('a.id', 'ASC');


        if($prix){
            $query = $query
                ->andWhere('a.prixArticle < :prixmax ')
                ->setParameter('prixmax',$prix);

        }


        if($cat){
            $query = $query
                ->andWhere('a.categories = :categoriesID')
                ->setParameter('categoriesID', $cat);
        }
        if($region){
            $query = $query
                ->andWhere('a.region = :regionID')
                ->setParameter('regionID', $region);
        }

        return $query->getQuery()->getResult();
    }

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Articles::class);
    }

    // /**
    //  * @return Articles[] Returns an array of Articles objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Articles
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}