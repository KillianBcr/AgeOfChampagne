<?php

namespace App\DataFixtures;

use App\Factory\PartenaireFactory;
use App\Factory\VigneronFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class PartenaireFixtures extends Fixture
{
    public function load(ObjectManager $manager): array
    {
        return  PartenaireFactory::createMany(15);
    }
}
