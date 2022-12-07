<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LandingController extends AbstractController
{
    #[Route('/landing', name: 'app_landing')]
    public function index(): Response
    {
        return $this->render('Landing/Landing.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }
}
