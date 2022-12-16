<?php

namespace App\Controller;

use App\Entity\Utilisateur;
use App\Repository\UtilisateurRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UtilisateurController extends AbstractController
{
    #[Route('/utilisateur', name: 'app_utilisateur')]
    public function index(UtilisateurRepository $repository): Response
    {
        $utilisateur = $repository->findBy([], ['nom' => 'ASC', 'prenom' => 'ASC']);

        return $this->render('utilisateur/index.html.twig', [
            'utilisateurs' => $utilisateur,
        ]);
    }
    #[Route('/utilisateur/{id}', name: 'app_utilisateur_show',
        requirements: [
            'id' => "\d+",
        ]
    )]
    public function show(Utilisateur $utilisateur): Response
    {

        return $this->render('utilisateur/show.html.twig',
            ['utilisateur' => $utilisateur]);
    }
}
