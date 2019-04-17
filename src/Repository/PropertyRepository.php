<?php
/**
 * PropertyRepository File Doc Comment
 * PHP version 7.3
 * 
 * @category Class
 * @package  Estate_Agency
 * @author   LauraDev <contact@lauradev.fr>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     ""
 */

namespace App\Repository;

use App\Entity\Property;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Doctrine\ORM\QueryBuilder;
use Doctrine\ORM\Query;

/**
 * PropertyRepository Class Doc Comment
 * 
 * @category Class
 * @package  Estate_Agency
 * @author   LauraDev <contact@lauradev.fr>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     ""
 * 
 * @method Property|null find($id, $lockMode = null, $lockVersion = null)
 * @method Property|null findOneBy(array $criteria, array $orderBy = null)
 * @method Property[]    findAll()
 * @method Property[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PropertyRepository extends ServiceEntityRepository
{
    /**
     * Constructor
     * 
     * @param RegistryInterface $registry Registry Interface
     */
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Property::class);
    }

    /**
     * Find all properties which are not sold
     * 
     * @return Query
     */
    public function findAllNotSoldQuery() : Query
    {
        return $this
            ->findNotSoldQuery()
            ->getQuery();
    }

    /**
     * Find the last 4 properties - not sold
     * 
     * @return Property[]
     */
    public function findLatest() : array
    {
        return $this
            ->findNotSoldQuery()
            ->setMaxResults(4)
            ->getQuery()
            ->getResult();
    }

    /**
     * Create the query to find the not sold properties
     * 
     * @return QueryBuilder
     */
    private function findNotSoldQuery() : QueryBuilder
    {
        return $this
            ->createQueryBuilder('p')
            ->where('p.sold = false')
            ->orderBy('p.created_at', 'ASC');
    }
}
