<?php

namespace App\Controller;

use App\Entity\Utilisateur;
use App\Form\UserType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class ProfileController extends AbstractController
{
    #[Route('/profile/edition/{id}', name: 'app_profile', requirements: [
        'id' => "\d+",
    ],
        methods: ['GET', 'POST'])]
    public function edit(Utilisateur $user, Request $request, EntityManagerInterface $manager, UserPasswordHasherInterface $hasher): Response
    {
        if (!$this->getUser()) {
            return $this->redirectToRoute('app_login');
        }

        if ($this->getUser() !== $user) {
            return $this->redirectToRoute('app_home');
        }

        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if ($hasher->isPasswordValid($user, $form->get('plainPassword')->getData())) {
                $user = $form->getData();
                $manager->persist($user);
                $manager->flush();
                $this->addFlash('success', 'Les informations de votre compte ont bien été modifiées');
                return $this->redirectToRoute('app_home');
            }
            else {
                $this->addFlash('warning', 'Mot de passe incorrect.');
            }
        }

        return $this->render('pages/user/edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
