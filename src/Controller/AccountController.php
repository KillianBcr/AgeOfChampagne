<?php

namespace App\Controller;

use App\Entity\Utilisateur;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AccountController extends AbstractController
{
    #[Route('/profile/{id}', name: 'app_account', requirements: [
        'id' => "\d+",
    ],
        methods: ['GET','POST'])]
    public function index(Utilisateur $user): Response
    {
        if (!$this->getUser())
        {
            return $this->redirectToRoute('app_login');
        }

        if ($this->getUser() !== $user)
        {
            return $this->redirectToRoute('app_home');
        }

        return $this->render('account/index.html.twig', [
            'user' => $user,
        ]);
    }
}
