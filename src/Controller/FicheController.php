<?php

namespace App\Controller;

use App\Entity\FichePartenaire;
use App\Form\FichePartenaireType;
use App\Repository\FichePartenaireRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FicheController extends AbstractController
{
    #[Route('/partenaire/fiche', name: 'app_fiche', methods: ['GET'])]
    public function index(FichePartenaireRepository $repository, Request $request): Response
    {
        $fiches =
            $repository->findAll()
        ;

        return $this->render('pages/fiche/index.html.twig', [
            'fiches' => $fiches,
        ]);
    }

    #[Route('/partenaire/fiche/creation', name: 'app_fiche_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $manager): Response
    {
        $fiche = new FichePartenaire();
        $form = $this->createForm(FichePartenaireType::class, $fiche);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $fiche = $form->getData();

            $manager->persist($fiche);
            $manager->flush();

            $this->addFlash(
                'success',
                'Votre fiche a été créé avec succès !'
            );

            return $this->redirectToRoute('app_fiche');
        }

        return $this->render('pages/fiche/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
