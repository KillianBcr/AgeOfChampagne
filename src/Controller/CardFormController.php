<?php

namespace App\Controller;

use App\Entity\Carte;
use App\Form\CarteType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use App\Form\ProductType;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class CardFormController extends AbstractController
{
    #[Route('/cardform', name: 'app_card_form')]
    public function index(Request $request,EntityManagerInterface $manager, SluggerInterface $slugger): Response
    {
        $form = $this->createForm(CarteType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid())
        {
            $carte = new Carte();
            $carte->setName($form->get('name')->getData());
            $carte->setQrCode($form->get('qrCode')->getData());
            $carte->setImageCarte($form->get('imageCarte')->getData());
            $carte->setDescription($form->get('description')->getData());
            $imageFile = $form->get('imageCarte')->getData();
            if ($imageFile) {
                $originalFilename = pathinfo($imageFile->getClientOriginalName(), PATHINFO_FILENAME);
                // this is needed to safely include the file name as part of the URL
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename.'-'.uniqid().'.'.$imageFile->guessExtension();

                // Move the file to the directory where brochures are stored
                try {
                    $imageFile->move(
                        $this->getParameter('card_directory'),
                        $newFilename
                    );
                } catch (FileException $e) {
                    // ... handle exception if something happens during file upload
                }

                // updates the 'brochureFilename' property to store the PDF file name
                // instead of its contents
                $card->setImageFilename($newFilename);
            }
            $manager->persist($carte);
            $manager->flush();
        }
        return $this->renderForm('pages/carte/add.html.twig', [
            'controller_name' => 'CardFormController',
            'formulaire' => $form
        ]);
    }
}