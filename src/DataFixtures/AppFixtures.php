<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Add;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
       
        /* $add = new Add();
         $faker = Factory::create('fr-FR');//FR-fr (en locale)
        
         $add->setIntroduction($faker->sentence());

         $manager->persist($add);
         $manager->flush();*/
    }
}
