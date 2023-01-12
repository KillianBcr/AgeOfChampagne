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
    public function showCollection($userId)
    {
        $em = $this->getDoctrine()->getManager();
        $query = $em->createQuery(
            'SELECT c.name FROM App\Entity\Carte c
             WHERE c.id IN (SELECT coll.cardID FROM App\Entity\Collection coll WHERE coll.userID = :userId'
        )->setParameter('userId', $userId);
        $collection = $query->getResult();
    
        return $this->render('index.html.twig', [
            'collection' => $collection
        ]);
    }
}
