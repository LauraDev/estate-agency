<?php
/**
 * PropertySearch File Doc Comment
 * PHP version 7.3
 * 
 * @category Class
 * @package  Estate_Agency
 * @author   LauraDev <contact@lauradev.fr>
 */

namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;

class PropertySearch
{
    /**
     * @var int|null
     */
    private $maxPrice;

    /**
     * @var int|null
     * @Assert\Range(min="10",max="400")
     */
    private $minSurface;


    /**
     * @var ArrayCollection
     */
    private $facilities;

    public function __construct()
    {
        $this->facilities = new ArrayCollection();
    }

    /**
     * Get the value of maxPrice
     *
     * @return int|null
     */ 
    public function getMaxPrice(): ?int
    {
        return $this->maxPrice;
    }

    /**
     * Set the value of maxPrice
     *
     * @param int|null $maxPrice 
     *
     * @return self
     */ 
    public function setMaxPrice(int $maxPrice): PropertySearch
    {
        $this->maxPrice = $maxPrice;

        return $this;
    }

    /**
     * Get the value of minSurface
     *
     * @return int|null
     */ 
    public function getMinSurface(): ?int
    {
        return $this->minSurface;
    }

    /**
     * Set the value of minSurface
     *
     * @param int|null $minSurface 
     *
     * @return self
     */ 
    public function setMinSurface(int $minSurface): PropertySearch
    {
        $this->minSurface = $minSurface;

        return $this;
    }


    /**
     * Get the value of facilities
     *
     * @return  ArrayCollection
     */ 
    public function getFacilities(): ArrayCollection
    {
        return $this->facilities;
    }

    /**
     * Set the value of facilities
     *
     * @param  ArrayCollection  $facilities
     *
     * @return  self
     */ 
    public function setFacilities(ArrayCollection $facilities): void
    {
        $this->facilities = $facilities;
    }
}
