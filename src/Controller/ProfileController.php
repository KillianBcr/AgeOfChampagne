<?php

namespace App\Controller;

use App\Entity\Utilisateur;
use App\Form\UserPasswordType;
use App\Form\UserType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class ProfileController extends AbstractController
{
    #[Route('/compte/{id}', name: 'app_profile', requirements: [
        'id' => "\d+",
    ],
        methods: ['GET', 'POST'])]
    public function index(Utilisateur $user): Response
    {
        return $this->render('pages/user/profile.html.twig', [
            'user' => $user
        ]);
    }

    #[Route('/compte/edition/{id}', name: 'app_profile_edit', requirements: [
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
                $currentUser = $this->getUser();
                $currentUser->setUpdateAt(new \DateTimeImmutable());
                $manager->flush();
                $this->addFlash('success', 'Les informations de votre compte ont bien été modifiées');

                return $this->redirectToRoute('app_home');
            } else {
                $this->addFlash('warning', 'Mot de passe incorrect.');
            }
        }

        return $this->render('pages/user/edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/compte/edition-mot-de-passe/{id}', name: 'app_edit_password', methods: ['GET', 'POST'])]
    public function editPassword(Utilisateur $user, Request $request, EntityManagerInterface $manager, UserPasswordHasherInterface $hasher): Response
    {
        $form = $this->createForm(UserPasswordType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            if ($hasher->isPasswordValid($user, $form->get('plainPassword')->getData())) {
                $currentUser = $this->getUser();
                $currentUser->setUpdateAt(new \DateTimeImmutable());
                $password = $form->get('newPassword')->getData();
                $user->setPassword(
                    $hasher->hashPassword($user, $password)
                );

                $this->addFlash(
                    'success',
                    'Le mot de passe a été modifié.'
                );

                $manager->persist($user);
                $manager->flush();

                return $this->redirectToRoute('app_home');
            } else {
                $this->addFlash(
                    'warning',
                    'Le mot de passe renseigné est incorrect.'
                );
            }
        }

        return $this->render('pages/user/edit_password.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
