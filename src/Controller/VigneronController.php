<?php

namespace App\Controller;

use App\Entity\Vigneron;
use App\Repository\VigneronRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class VigneronController extends AbstractController
{
    #[IsGranted('IS_AUTHENTICATED_FULLY')]
    #[Route('/vigneron', name: 'app_vigneron')]
    public function index(VigneronRepository $repository): Response
    {
        $vignerons = $repository->findBy([], ['nom' => 'ASC', 'prenom' => 'ASC']);

        return $this->render('vigneron/index.html.twig', [
            'vignerons' => $vignerons,
        ]);
    }

    #[IsGranted('IS_AUTHENTICATED_FULLY')]
    #[Route('/vigneron/{id}', name: 'app_vigneron_show',
        requirements: [
            'id' => "\d+",
        ]
    )]
    public function show(Vigneron $vigneron): Response
    {

        return $this->render('vigneron/show.html.twig',
            ['vigneron' => $vigneron]);
    }

}
