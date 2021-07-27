<?php

namespace App\DataFixtures;

use App\Entity\Condidature;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create();

        for ($i = 0; $i < 50; $i++) {
            $condidature = new Condidature();
            $condidature->setApplicateur($faker->applicateur);
            $condidature->setPatisserie($faker->patisserie);
            $condidature->setEtat($faker->etat);
            $condidature->setMessage($faker->message);
            $manager->persist($condidature);
        }

        $manager->flush();
    }
}
