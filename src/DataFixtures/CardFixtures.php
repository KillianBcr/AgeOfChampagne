<?php

namespace App\DataFixtures;

use App\Entity\Carte;
use App\Factory\CarteFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\File\File;

class CardFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $cartes = [];
        $carte1 = new Carte();
        $carte1->setName('Bassuet')
            ->setQrCode('1')
            ->setDescription('Une petite description')
            ->setImageFile(new File('public/images/card/aoc-coteauxvitryats-bassuet.png'));
        $carte1->setImageName('aoc-coteauxvitryats-bassuet.png');
        $manager->persist($carte1);
        $cartes[] = $carte1;

        $carte2 = new Carte();
        $carte2->setName('Baroville')
            ->setQrCode('1')
            ->setDescription('Une petite description')
            ->setImageFile(new File('public/images/card/aoc-cotedesbar-baroville.png'));
        $carte2->setImageName('aoc-cotedesbar-baroville.png');
        $manager->persist($carte2);
        $cartes[] = $carte2;


        $carte3 = new Carte();
        $carte3->setName('Chouilly')
            ->setQrCode('1')
            ->setDescription('Une petite description')
            ->setImageFile(new File('public/images/card/aoc-cotedesblancs-chouilly.png'));
        $carte3->setImageName('aoc-cotedesblancs-chouilly.png');
        $manager->persist($carte3);
        $cartes[] = $carte3;

        $carte4 = new Carte();
        $carte4->setName('Barbonne Fayel')
            ->setQrCode('1')
            ->setDescription('Une petite description')
            ->setImageFile(new File('public/images/card/aoc-cotedesezanne-barbonnefayel.png'));
        $carte4->setImageName('aoc-cotedesezanne-barbonnefayel.png');
        $manager->persist($carte4);
        $cartes[] = $carte4;

        $manager->flush();
    }
}
