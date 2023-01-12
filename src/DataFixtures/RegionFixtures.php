<?php

namespace App\DataFixtures;

use App\Factory\RegionFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class RegionFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $region= file_get_contents(__DIR__ . '/data/Regions.json',true);
        $regions = json_decode($region,true);

        foreach($regions as $elmt)
        {
            RegionFactory::createOne([
                'nom' => $elmt['nom'],
            ]);
        }
    }
}
