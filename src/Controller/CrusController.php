<?php

namespace App\Controller;

use App\Entity\Crus;
use App\Repository\CrusRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CrusController extends AbstractController
{
    #[Route('/crus', name: 'app_crus')]
    public function index(CrusRepository $repository): Response
    {
        $crus = $repository->findBy([], ['nom' => 'ASC']);

        return $this->render('pages/crus/index.html.twig', [
            'crus' => $crus,
        ]);
    }

    #[Route('/crus/{id}/carte', name: 'app_crus_show',
        requirements: [
            'id' => "\d+",
        ]
    )]

    public function show(Crus $crus): Response
    {
        return $this->render('pages/crus/show.html.twig',
            ['crus' => $crus]);
    }
}
