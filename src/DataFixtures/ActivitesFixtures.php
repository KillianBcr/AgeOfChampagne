<?php

namespace App\DataFixtures;

use App\Factory\ActiviteFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ActivitesFixtures extends Fixture
{
    public function load(ObjectManager $manager): array
    {
        return  ActiviteFactory::createMany(10);
    }
}
