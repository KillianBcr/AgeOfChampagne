<?php

namespace App\Controller;

use App\Entity\Activite;
use App\Repository\ActiviteRepository;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ActiviteController extends AbstractController
{

    #[IsGranted('ROLE_ADMIN')]
    #[Route('/activite/edition', name: 'app_activite', methods: ['GET'])]
    public function index(ActiviteRepository $repository, Request $request): Response
    {
        $activites = $repository->findAll();
        return $this->render('pages/activite/index.html.twig', [
            'activites' => $activites,
        ]);
    }


    #[IsGranted('ROLE_USER')]
    #[Route('/activite', name: 'app_activite_public')]
    public function indexPublic(ActiviteRepository $repository): Response
    {
        $activites = $repository->findAll();

        return $this->render('pages/activite/index.public.html.twig', [
            'activites' => $activites,
        ]);
    }

    #[IsGranted('ROLE_USER')]
    #[Route('/activite/{id}', name: 'app_activite_show',
        requirements: [
            'id' => "\d+",
        ]
    )]
    public function show(Activite $activite): Response
    {
        return $this->render('pages/activite/show.html.twig',
            ['ativite' => $activite]);
    }

    #[Security("is_granted('ROLE_ADMIN')")]
    #[Route('/activite/edition/{id}', 'app_activite_edit', methods: ['GET', 'POST'])]
    public function edit(Activite $activite, Request $request, EntityManagerInterface $manager): Response
    {
        $form = $this->createForm(Activite::class, $activite);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $activite = $form->getData();
            $activite->setUpdatedAt(new \DateTimeImmutable());
            $manager->persist($activite);
            $manager->flush();

            $this->addFlash(
                'success',
                'Votre activité a été modifié avec succès !'
            );

            return $this->redirectToRoute('app_activite');
        }

        return $this->render('pages/activite/edit.html.twig', [
            'activite' => $form->createView(),
        ]);
    }

    // Suppression
    #[Security("is_granted('ROLE_ADMIN')")]
    #[Route('/activite/suppression/{id}', 'app_activite_delete', methods: ['GET'])]
    public function delete(EntityManagerInterface $manager, Activite $activite): Response
    {
        $manager->remove($activite);
        $manager->flush();

        $this->addFlash(
            'success',
            'Votre activité a été supprimé avec succès !'
        );

        return $this->redirectToRoute('app_activite');
    }
}


