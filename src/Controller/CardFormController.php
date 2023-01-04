<?php

namespace App\Controller;

use App\Entity\Carte;
use App\Form\CarteType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

class CardFormController extends AbstractController
{
    #[Route('/cardform', name: 'app_card_form')]
    public function index(Request $request, EntityManagerInterface $manager, SluggerInterface $slugger): Response
    {
        $form = $this->createForm(CarteType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $carte = new Carte();
            $carte->setName($form->get('name')->getData());
            $carte->setQrCode($form->get('qrCode')->getData());
            $carte->setDescription($form->get('description')->getData());
            $manager->persist($carte);
            $manager->flush();
        }

        return $this->renderForm('pages/carte/add.html.twig', [
            'controller_name' => 'CardFormController',
            'formulaire' => $form,
        ]);
    }
}
