<?php

namespace App\Controller;

use App\Entity\Carte;
use App\Form\CarteType;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

class CardFormController extends AbstractController
{
    #[IsGranted('ROLE_ADMIN')]
    #[Route('/cardform', name: 'app_card_form', methods: ['GET', 'POST'])]
    public function index(Request $request, EntityManagerInterface $manager, SluggerInterface $slugger): Response
    {
        $carte = new Carte();
        $form = $this->createForm(CarteType::class, $carte);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $carte = $form->getData();
            $manager->persist($carte);
            $manager->flush();

            $this->addFlash(
                'success',
                'Carte ajoutée !'
            );
            return $this->redirectToRoute('app_carte');

        }

        return $this->renderForm('pages/carte/add.html.twig', [
            'controller_name' => 'CardFormController',
            'formulaire' => $form,
        ]);
    }
}
