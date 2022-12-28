<?php

namespace App\DataFixtures;

use App\Factory\CarteFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CardFixtures extends Fixture
{
    public function load(ObjectManager $manager): array
    {
        return CarteFactory::createMany(10);
    }
}
