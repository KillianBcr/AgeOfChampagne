<?php

namespace App\Controller;

use App\Entity\Carte;
use App\Form\CarteType;
use App\Repository\CarteRepository;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CarteController extends AbstractController
{
    #[IsGranted('ROLE_USER')]
    #[Route('/carte', name: 'app_carte_public')]
    public function index(CarteRepository $repository): Response
    {
        $cartes = $repository->findAll();

        return $this->render('pages/carte/index.public.html.twig', [
            'cartes' => $cartes,
        ]);
    }


    #[IsGranted('ROLE_USER')]
    #[Route('/carte/{id}', name: 'app_carte_show',
        requirements: [
            'id' => "\d+",
        ]
    )]
    public function show(Carte $carte): Response
    {

        return $this->render('pages/carte/show.html.twig',
            ['carte' => $carte]);
    }

    #[Security("is_granted('ROLE_ADMIN')")]
    #[Route('/carte/edition/{id}', 'app_carte_edit', methods: ['GET', 'POST'])]
    public function edit(Carte $carte, Request $request, EntityManagerInterface $manager): Response
    {
        $form = $this->createForm(CarteType::class, $carte);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $carte = $form->getData();
            $carte->setUpdatedAt(new \DateTimeImmutable());
            $manager->persist($carte);
            $manager->flush();

            $this->addFlash(
                'success',
                'Votre carte a été modifié avec succès !'
            );

            return $this->redirectToRoute('app_carte');
        }

        return $this->render('pages/carte/edit.html.twig', [
            'carte' => $form->createView(),
        ]);
    }

    // Suppression
    #[Security("is_granted('ROLE_ADMIN')")]
    #[Route('/carte/suppression/{id}', 'app_carte_delete', methods: ['GET'])]
    public function delete(EntityManagerInterface $manager, Carte $carte): Response
    {
        $manager->remove($carte);
        $manager->flush();

        $this->addFlash(
            'success',
            'Votre carte a été supprimé avec succès !'
        );

        return $this->redirectToRoute('app_carte');
    }
}