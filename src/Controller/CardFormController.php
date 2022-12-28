<?php

namespace App\Controller;

use App\Entity\Carte;
use App\Form\CarteType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CardFormController extends AbstractController
{
    #[Route('/cardform', name: 'app_card_form')]
    public function index(Request $request,EntityManagerInterface $manager): Response
    {
        $form = $this->createForm(CarteType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid())
        {
            $carte = new Carte();
            $carte->setQrCode($form->get('qrCode')->getData());
            $carte->setImageCarte($form->get('imageCarte')->getData());
            $manager->persist($carte);
            $manager->flush();

        }
        return $this->renderForm('pages/carte/add.html.twig', [
            'controller_name' => 'CardFormController',
            'formulaire' => $form
        ]);
    }
}