<?php

namespace App\Controller;

use App\Entity\FichePartenaire;
use App\Form\FichePartenaireType;
use App\Repository\FichePartenaireRepository;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FicheController extends AbstractController
{
    #[IsGranted('ROLE_ADMIN')]
    #[Route('/partenaire/fiche', name: 'app_fiche', methods: ['GET'])]
    public function index(FichePartenaireRepository $repository, Request $request): Response
    {
        /*
        $fiches =
            $repository->findBy(['utilisateur' => $this->getUser()])
        ;
        */
        $fiches = $repository->findAll();
        return $this->render('pages/fiche/index.html.twig', [
            'fiches' => $fiches,
        ]);
    }

    #[IsGranted('IS_AUTHENTICATED_FULLY')]
    #[Route('/partenaires', name: 'app_fiche_public', methods: ['GET'])]
    public function indexPublic(FichePartenaireRepository $repository, Request $request): Response
    {
        $fiches = $repository->findPublicFiche(null);

        return $this->render('pages/fiche/index.public.html.twig', [
            'fiches' => $fiches,
        ]);
    }

    #[Security("is_granted('ROLE_USER') and fiche.getIsPublic() === true")]
    #[Route('/partenaires/fiche/{id}', name: 'app_fiche_show', methods: ['GET'])]
    public function show(FichePartenaire $fiche): Response
    {
        return $this->render('pages/fiche/show.html.twig', [
            'fiche' => $fiche,
        ]);
    }

    #[IsGranted('ROLE_ADMIN')]
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

    // Edition de la fiche partenaire
    #[Security("is_granted('ROLE_ADMIN')")]
    #[Route('/partenaire/fiche/edition/{id}', 'app_fiche_edit', methods: ['GET', 'POST'])]
    public function edit(FichePartenaire $fiche, Request $request, EntityManagerInterface $manager): Response
    {
        $form = $this->createForm(FichePartenaireType::class, $fiche);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $fiche = $form->getData();
            $fiche->setUpdatedAt(new \DateTimeImmutable());
            $manager->persist($fiche);
            $manager->flush();

            $this->addFlash(
                'success',
                'Votre fiche a été modifié avec succès !'
            );

            return $this->redirectToRoute('app_fiche');
        }

        return $this->render('pages/fiche/edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    // Suppression
    #[Security("is_granted('ROLE_ADMIN')")]
    #[Route('/partenaire/suppression/{id}', 'app_fiche_delete', methods: ['GET'])]
    public function delete(EntityManagerInterface $manager, FichePartenaire $fiche): Response
    {
        $manager->remove($fiche);
        $manager->flush();

        $this->addFlash(
            'success',
            'Votre fiche a été supprimé avec succès !'
        );

        return $this->redirectToRoute('app_fiche');
    }
}
