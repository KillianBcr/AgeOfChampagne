<?php

namespace App\DataFixtures;
use src\Factory\UtilisateurFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class UserFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
      return UtilisateurFactory::createMany(10);
    }
}
