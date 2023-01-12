<?php

namespace App\DataFixtures;

use App\Entity\Carte;
use App\Factory\CarteFactory;
use App\Factory\CrusFactory;
use App\Repository\CepageRepository;
use App\Repository\CrusRepository;
use App\Repository\RegionRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\File\File;

class CardFixtures extends Fixture implements DependentFixtureInterface
{
    public CepageRepository $repository;
    public CrusRepository $repository2;
    public RegionRepository $repository3;
    public function __construct(CepageRepository $repository, CrusRepository $repository2, RegionRepository $repository3)
    {
        $this->repository = $repository;
        $this->repository2 = $repository2;
        $this->repository3 = $repository3;
    }
    public function load(ObjectManager $manager): void
    {
        $carte= file_get_contents(__DIR__ . '/data/Cartes.json',true);
        $cartes = json_decode($carte,true);

        $crusRepository = $this->repository2;
        $cepageRepository = $this->repository;
        $regionRepository = $this->repository3;

        foreach($cartes as $elmt)
        {
            $carte = CarteFactory::createOne([
                'name' => $elmt['name'],
                'description' => $elmt['description'],
                'qrCode' => $elmt['qrCode'],
                'cepage' => $cepageRepository->find($elmt['cepage']),
                'crus' => $crusRepository->find($elmt['crus']),
                'region' => $regionRepository->find($elmt['region']),
                'imageName' => $elmt['imageName'],
                'imageFile' => new File( $elmt['imageFile']),
            ]);
        }
    }

    public function getDependencies()
    {
        return [
            CepageFixtures::class,
            CrusFixtures::class,
            RegionFixtures::class,
        ];
    }
}
