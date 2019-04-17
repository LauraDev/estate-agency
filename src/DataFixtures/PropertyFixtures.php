<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Property;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class PropertyFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');
        for ($i = 0; $i < 100; $i++)
        {
            $property = new Property();
            $property
                ->setTitle($faker->words(3, true))
                ->setPrice($faker->numberBetween(100000, 1000000))
                ->setDescription($faker->sentences(3, true))
                ->setSurface($faker->numberBetween(20, 350))
                ->setRooms($faker->numberBetween(2, 10))
                ->setBedrooms($property->getRooms()-1)
                ->setFloor($faker->numberBetween(0, 15))
                ->setHeat($faker->numberBetween(0, count(Property::heat)-1))
                ->setAddress($faker->address)
                ->setCity($faker->city)
                ->setPostcode($faker->postcode);

            $manager->persist($property);
        }

        $manager->flush();
    }
}
