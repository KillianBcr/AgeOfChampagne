<?php

namespace App\Controller;

use App\Entity\Utilisateur;
use App\Form\UserType;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\User;

class ProfileController extends AbstractController
{
    #[Route('/compte/edition/{id}', name: 'app_profile', requirements: [
        'id' => "\d+",
    ],
        methods: ['GET','POST'])]
    public function edit(Utilisateur $user, Request $request, EntityManagerInterface $manager): Response
    {
        if (!$this->getUser())
        {
            return $this->redirectToRoute('app_login');
        }

        if ($this->getUser() !== $user)
        {
            return $this->redirectToRoute('app_home');
        }

        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $user = $form->getData();
            $manager->persist($user);
            $manager->flush();
            $this->addFlash('success','Les informations de votre compte ont bien été modifiées');
            return $this->redirectToRoute('app_home');
        }
        return $this->render('profile/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
