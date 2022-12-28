<?php

namespace App\Controller;

use App\Form\CarteType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CardFormController extends AbstractController
{
    #[Route('/cardform', name: 'app_card_form')]
    public function index(): Response
    {
        $form = $this->createForm(CarteType::class);

        return $this->renderForm('pages/carte/add.html.twig', [
            'controller_name' => 'CardFormController',
            'formulaire' => $form
        ]);
    }
}
