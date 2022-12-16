<?php

namespace App\Controller;

use App\Repository\PartenaireRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PartenaireController extends AbstractController
{
    #[IsGranted('IS_AUTHENTICATED_FULLY')]
    #[Route('/partenaire', name: 'app_partenaire')]
    public function index(PartenaireRepository $repository): Response
    {
        $partenaires = $repository->findBy([], ['nom' => 'ASC']);

        return $this->render('partenaire/index.html.twig', [
            'partenaires' => $partenaires,
        ]);
    }
}
