<?php

namespace App\DataFixtures;

use App\Entity\Crus;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CrusFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $cru = [];

        $crus1 = new Crus();
        $crus1->setNom('Aÿ')
            ->setCepage('Pinots noirs')
            ->setDescription('Une petite description');
        $manager->persist($crus1);
        $cru[] = $crus1;

        $crus2 = new Crus();
        $crus2->setNom('Barbonne-Fayel')
            ->setCepage('Chardonnay')
            ->setDescription('Une petite description');
        $manager->persist($crus2);
        $cru[] = $crus2;

        $crus3 = new Crus();
        $crus3->setNom('Baroville')
            ->setCepage('Pinots noirs')
            ->setDescription('Une petite description');
        $manager->persist($crus3);
        $cru[] = $crus3;

        $crus4 = new Crus();
        $crus4->setNom('Bassuet')
            ->setCepage('Chardonnay')
            ->setDescription('Une petite description');
        $manager->persist($crus4);
        $cru[] = $crus4;

        $crus5 = new Crus();
        $crus5->setNom('Bethon')
            ->setCepage('Chardonnay')
            ->setDescription('Une petite description');
        $manager->persist($crus5);
        $cru[] = $crus5;

        $crus6 = new Crus();
        $crus6->setNom('Celles-sur-Ource')
            ->setCepage('Pinots noirs')
            ->setDescription('Une petite description');
        $manager->persist($crus6);
        $cru[] = $crus6;

        $crus7 = new Crus();
        $crus7->setNom('Chamery')
            ->setCepage('Meniers')
            ->setDescription('Une petite description');
        $manager->persist($crus7);
        $cru[] = $crus7;

        $crus8 = new Crus();
        $crus8->setNom('Charly-sur-Marne')
            ->setCepage('Meniers')
            ->setDescription('Une petite description');
        $manager->persist($crus8);
        $cru[] = $crus8;

        $crus9 = new Crus();
        $crus9->setNom('Châtillion-sur-Marne')
            ->setCepage('Meniers')
            ->setDescription('Une petite description');
        $manager->persist($crus9);
        $cru[] = $crus9;

        $crus10 = new Crus();
        $crus10->setNom('Chouilly')
            ->setCepage('Chardonnay')
            ->setDescription('Une petite description');
        $manager->persist($crus10);
        $cru[] = $crus10;

        $crus11 = new Crus();
        $crus11->setNom('Crouttes-sur-Marne')
            ->setCepage('Meniers')
            ->setDescription('Une petite description');
        $manager->persist($crus11);
        $cru[] = $crus11;

        $crus12 = new Crus();
        $crus12->setNom('Damey')
            ->setCepage('Meniers')
            ->setDescription('Une petite description');
        $manager->persist($crus12);
        $cru[] = $crus12;

        $crus13 = new Crus();
        $crus13->setNom('Dormans')
            ->setCepage('Meniers')
            ->setDescription('Une petite description');
        $manager->persist($crus13);
        $cru[] = $crus13;

        $crus14 = new Crus();
        $crus14->setNom('Epernay')
            ->setCepage('Chardonnay')
            ->setDescription('Une petite description');
        $manager->persist($crus14);
        $cru[] = $crus14;

        $crus15 = new Crus();
        $crus15->setNom('Essômes-sur-Marne')
            ->setCepage('Meniers')
            ->setDescription('Une petite description');
        $manager->persist($crus15);
        $cru[] = $crus15;

        $crus16 = new Crus();
        $crus16->setNom('Essoyes')
            ->setCepage('Pinots Noir')
            ->setDescription('Une petite description');
        $manager->persist($crus16);
        $cru[] = $crus16;

        $crus17 = new Crus();
        $crus17->setNom('Le Mesnil-sur-Oger')
            ->setCepage('Chardonnay')
            ->setDescription('Une petite description');
        $manager->persist($crus17);
        $cru[] = $crus17;

        $crus18 = new Crus();
        $crus18->setNom('Les Receys')
            ->setCepage('Pinots Noir')
            ->setDescription('Une petite description');
        $manager->persist($crus18);
        $cru[] = $crus18;

        $crus19 = new Crus();
        $crus19->setNom('Loches-sur-Ource')
            ->setCepage('Pinots Noir')
            ->setDescription('Une petite description');
        $manager->persist($crus19);
        $cru[] = $crus19;

        $crus20 = new Crus();
        $crus20->setNom('Mareuil-le-Port')
            ->setCepage('Meniers')
            ->setDescription('Une petite description');
        $manager->persist($crus20);
        $cru[] = $crus20;

        $crus21 = new Crus();
        $crus21->setNom('Mareuil-sur-Aÿ')
            ->setCepage('Pinots Noir')
            ->setDescription('Une petite description');
        $manager->persist($crus21);
        $cru[] = $crus21;

        $crus22 = new Crus();
        $crus22->setNom('Meuville')
            ->setCepage('Pinots Noir')
            ->setDescription('Une petite description');
        $manager->persist($crus22);
        $cru[] = $crus22;

        $crus23 = new Crus();
        $crus23->setNom('Neuville-sur-Seine')
            ->setCepage('Pinots Noir')
            ->setDescription('Une petite description');
        $manager->persist($crus23);
        $cru[] = $crus23;

        $crus24 = new Crus();
        $crus24->setNom("Nogent-l'Abesse")
            ->setCepage('Chardonnay')
            ->setDescription('Une petite description');
        $manager->persist($crus24);
        $cru[] = $crus24;

        $crus25 = new Crus();
        $crus25->setNom("Sézanne")
            ->setCepage('Chardonnay')
            ->setDescription('Une petite description');
        $manager->persist($crus25);
        $cru[] = $crus25;

        $crus26 = new Crus();
        $crus26->setNom('Trélou-sur-Marne')
            ->setCepage('Meuniers')
            ->setDescription('Une petite description');
        $manager->persist($crus26);
        $cru[] = $crus26;

        $crus27 = new Crus();
        $crus27->setNom('Trépail')
            ->setCepage('Chardonnay')
            ->setDescription('Une petite description');
        $manager->persist($crus27);
        $cru[] = $crus27;

        $crus28 = new Crus();
        $crus28->setNom('Trigny')
            ->setCepage('Meuniers')
            ->setDescription('Une petite description');
        $manager->persist($crus28);
        $cru[] = $crus28;

        $crus29 = new Crus();
        $crus29->setNom('Urnville')
            ->setCepage('Pinots noirs')
            ->setDescription('Une petite description');
        $manager->persist($crus29);
        $cru[] = $crus29;

        $crus30 = new Crus();
        $crus30->setNom('Verneuil')
            ->setCepage('Meuniers')
            ->setDescription('Une petite description');
        $manager->persist($crus30);
        $cru[] = $crus30;

        $crus31 = new Crus();
        $crus31->setNom('Vertus')
            ->setCepage('Chardonnay')
            ->setDescription('Une petite description');
        $manager->persist($crus31);
        $cru[] = $crus31;

        $crus32 = new Crus();
        $crus32->setNom('Verzenay')
            ->setCepage('Pinots noirs')
            ->setDescription('Une petite description');
        $manager->persist($crus32);
        $cru[] = $crus32;

        $crus33 = new Crus();
        $crus33->setNom('Verzy')
            ->setCepage('Pinots noirs')
            ->setDescription('Une petite description');
        $manager->persist($crus33);
        $cru[] = $crus33;

        $crus34 = new Crus();
        $crus34->setNom('Villedommange')
            ->setCepage('Meuniers')
            ->setDescription('Une petite description');
        $manager->persist($crus34);
        $cru[] = $crus34;

        $crus35 = new Crus();
        $crus35->setNom('Villers-Marmery')
            ->setCepage('Chardonnay')
            ->setDescription('Une petite description');
        $manager->persist($crus35);
        $cru[] = $crus35;

        $crus36 = new Crus();
        $crus36->setNom('Vitry-en-Perthois')
            ->setCepage('Chardonnay')
            ->setDescription('Une petite description');
        $manager->persist($crus36);
        $cru[] = $crus36;






        $manager->flush();
    }
}
