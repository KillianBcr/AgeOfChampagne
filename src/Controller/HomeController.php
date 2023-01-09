<?php

namespace App\Controller;

use App\Entity\Comment;
use App\Repository\CommentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\CommentType;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\Request;


class HomeController extends AbstractController
{
    /**
     * @Route("home", name="app_home")
     */
    #[IsGranted('ROLE_USER')]
    #[Route(name: 'comment_form', methods: ['GET', 'POST'])]
    public function index(Request $request, EntityManagerInterface $manager): Response
    {
        $comment = new Comment();
        $form = $this->createForm(CommentType::class, $comment);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $comment = $form->getData();
            if (strlen($comment->getSender()) == 0 ) {
                $comment->setSender("Anonyme");
            }
            $manager->persist($comment);
            $manager->flush();

            $this->addFlash(
                'success',
                'Commentaire ajoutée !'
            );

        }

        return $this->renderForm('pages/home.html.twig', [
            'controller_name' => 'HomeController',
            'comment' => $form,
        ]);
    }
}
