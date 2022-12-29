<?php

namespace App\Controller;

use App\Repository\FichePartenaireRepository;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FicheController extends AbstractController
{
    #[Route('/partenaire/fiche', name: 'app_fiche', methods: ['GET'])]
    public function index(FichePartenaireRepository $repository, Request $request): Response
    {
        $fiches =
            $repository->findAll()
       ;

        return $this->render('pages/fiche/index.html.twig', [
            'fiches' => $fiches,
        ]);
    }
}
