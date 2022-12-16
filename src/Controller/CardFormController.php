<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CardFormController extends AbstractController
{
    #[Route('/card/form', name: 'app_card_form')]
    public function index(): Response
    {
        return $this->render('card_form/index.html.twig', [
            'controller_name' => 'CardFormController',
        ]);
    }
}
