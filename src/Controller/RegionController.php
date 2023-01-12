<?php

namespace App\Controller;

use App\Entity\Region;
use App\Repository\RegionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RegionController extends AbstractController
{
    #[Route('/region', name: 'app_region')]
    public function index(RegionRepository $repository): Response
    {
        $region = $repository->findBy([], ['nom' => 'ASC']);

        return $this->render('pages/region/index.html.twig', [
            'regions' => $region,
        ]);
    }

    #[Route('/region/{id}/carte', name: 'app_region_show',
        requirements: [
            'id' => "\d+",
        ]
    )]

    public function show(Region $region): Response
    {
        return $this->render('pages/region/show.html.twig',
            ['regions' => $region]);
    }
}
