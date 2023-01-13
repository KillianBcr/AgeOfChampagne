<?php

namespace App\Controller;

use App\Entity\Collection;
use App\Repository\CollectionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

class CollectionController extends AbstractController
{
    #[IsGranted('ROLE_USER')]
    #[Route('/collection', name: 'app_collection')]
    public function index(): Response
    {
        return $this->render('pages/collection/index.html.twig', [
            'controller_name' => 'CollectionController',
        ]);
    }
    #[IsGranted('IS_AUTHENTICATED_FULLY')]
    #[Route('/collection', name: 'app_collection')]
    public function showCollection(CollectionRepository $repository)
    {
        $utilisateur = $this->getUser();
        $idUtilisateur = $utilisateur->getId();
        $collection = $repository->findAll();
        $em = $this->getDoctrine()->getManager();
        $query = $em->createQuery(
            'SELECT c.name, c.description, c.imageName, c.id FROM App\Entity\Carte c
             WHERE c.id IN (SELECT coll.cardID FROM App\Entity\Collection coll WHERE coll.userID = :idUtilisateur)');
            $query->setParameter('idUtilisateur',$idUtilisateur);
        $collection = $query->getResult();

        return $this->render('pages/collection/index.html.twig', [
            'collection' => $collection
        ]);
    }
}
