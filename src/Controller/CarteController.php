<?php

namespace App\Controller;

use App\Entity\Carte;
use App\Repository\CarteRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CarteController extends AbstractController
{
    #[IsGranted('ROLE_USER')]
    #[Route('/carte', name: 'app_carte')]
    public function index(CarteRepository $repository): Response
    {
        $cartes = $repository->findAll();

        return $this->render('pages/carte/index.html.twig', [
            'cartes' => $cartes,
        ]);
    }

    #[IsGranted('ROLE_USER')]
    #[Route('/carte/{id}', name: 'app_carte_show',
        requirements: [
            'id' => "\d+",
        ]
    )]
    public function show(Carte $carte): Response
    {
        return $this->render('pages/carte/show.html.twig',
            ['carte' => $carte]);
    }
}
