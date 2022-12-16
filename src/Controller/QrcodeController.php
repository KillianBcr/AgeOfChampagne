<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class QrcodeController extends AbstractController
{
    #[IsGranted('IS_AUTHENTICATED_FULLY', statusCode: 404, message: 'Post not found')]
    #[Route('/qrcode', name: 'app_qrcode')]
    public function index(): Response
    {
        return $this->render('qrcode/index.html.twig', [
            'controller_name' => 'QrcodeController',
        ]);
    }
}
