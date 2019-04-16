<?php

namespace App\Repository;

use App\Entity\Property;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Doctrine\ORM\QueryBuilder;

/**
 * @method Property|null find($id, $lockMode = null, $lockVersion = null)
 * @method Property|null findOneBy(array $criteria, array $orderBy = null)
 * @method Property[]    findAll()
 * @method Property[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PropertyRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Property::class);
    }

    // /**
    //  * @return Property[] Returns an array of Property objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Property
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    /**
     * @return Property[]
     */
    public function findAllNotSold() : array
    {
        return $this->findNotSoldQuery()
                    ->getQuery()
                    ->getResult()
        ;
    }

    /**
     * @return Property[]
     */
    public function findLatest() : array
    {
        return $this->findNotSoldQuery()
                    ->setMaxResults(4)
                    ->getQuery()
                    ->getResult()
        ;
    }

    /**
     * @return Property[]
     */
    private function findNotSoldQuery() : QueryBuilder
    {
        return $this->createQueryBuilder('p')
            ->where('p.sold = false')
            ->orderBy('p.created_at', 'ASC')
        ;
    }
}
