<?php

namespace App\Controller\Admin;

use App\Entity\Partenaire;
use App\Repository\PartenaireRepository;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PartenaireCrudController extends AbstractCrudController
{
    #[IsGranted('IS_AUTHENTICATED_FULLY')]
    #[Route('/partenaire', name: 'app_partenaire')]
    public function index(PartenaireRepository $repository): Response
    {
        $partenaires = $repository->findBy([], ['nom' => 'ASC']);

        return $this->render('pages/partenaire/index.html.twig', [
            'partenaires' => $partenaires,
        ]);
    }

    #[IsGranted('IS_AUTHENTICATED_FULLY')]
    #[Route('/partenaire/{id}', name: 'app_partenaire_show',
        requirements: [
            'id' => "\d+",
        ]
    )]
    public function show(Partenaire $partenaire): Response
    {

        return $this->render('pages/partenaire/show.html.twig',
            ['partenaire' => $partenaire]);
    }
}
