<?php

namespace App\Controller;

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
}
