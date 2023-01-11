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
use Symfony\Component\String\Slugger\SluggerInterface;

class CarteController extends AbstractController
{
    #[IsGranted('ROLE_ADMIN')]
    #[Route('/carte/edition', name: 'app_carte', methods: ['GET'])]
    public function index(CarteRepository $repository, Request $request): Response
    {
        $search = $request->query->get('search');
        if (null == $search) {
            $search = '';
        }
        $cartes = $repository->search($search);

        return $this->render('pages/carte/index.html.twig', [
            'cartes' => $cartes,
            'search' => $search,
        ]);
    }

    #[IsGranted('ROLE_USER')]
    #[Route('/carte', name: 'app_carte_public')]
    public function indexPublic(CarteRepository $repository, Request $request): Response
    {
        $search = $request->query->get('search');
        if (null == $search) {
            $search = '';
        }
        $cartes = $repository->search($search);

        return $this->render('pages/carte/index.public.html.twig', [
            'cartes' => $cartes,
            'search' => $search,
        ]);
    }

    #[IsGranted('ROLE_ADMIN')]
    #[Route('/carte/ajouter', name: 'app_card_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $manager, SluggerInterface $slugger): Response
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
            'form' => $form,
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