<?php

namespace App\DataFixtures;

use App\Entity\Cepage;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CepageFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $cepages = [];
        $cepage1 = new Cepage();
        $cepage1->setName('Chardonnay');
        $cepages[]= $cepage1;

        $cepages = [];
        $cepage2 = new Cepage();
        $cepage2->setName('Pinots noirs');
        $cepages[]= $cepage2;

        $cepages = [];
        $cepage3 = new Cepage();
        $cepage3->setName('Meuniers');
        $cepages[]= $cepage3;

        $manager->flush($cepages);
    }
}
