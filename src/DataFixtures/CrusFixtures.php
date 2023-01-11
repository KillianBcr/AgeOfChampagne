<?php

namespace App\DataFixtures;

use App\Entity\Crus;
use App\Factory\CrusFactory;
use App\Repository\CepageRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CrusFixtures extends Fixture
{
    public CepageRepository $repository;
    public function __construct(CepageRepository $repository)
    {
        $this->repository = $repository;
    }
    public function load(ObjectManager $manager): void
    {
        $chardonnay= file_get_contents(__DIR__ . '/data/Crus_Chardonnay.json',true);
        $crusChardonnay = json_decode($chardonnay,true);

        $cepageRepository = $this->repository;

        foreach($crusChardonnay as $elmt)
        {
            CrusFactory::createOne([
                'nom' => $elmt['nom'],
                'description' => $elmt['description'],
                'cepage' => $cepageRepository->find($elmt['cepage'])
            ]);
        }
    }

    public function getDependencies()
    {
        return [
            CepageFixtures::class,
        ];
    }
}
