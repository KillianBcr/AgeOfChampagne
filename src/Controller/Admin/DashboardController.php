<?php

namespace App\Controller\Admin;

use App\Entity\Carte;
use App\Entity\Cepage;
use App\Entity\Crus;
use App\Entity\FichePartenaire;
use App\Entity\Partenaire;
use App\Entity\Utilisateur;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        return $this->render('admin/index.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('AOC - Administration')->renderContentMaximized();
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('Utilisateurs', 'fa fa-user', Utilisateur::class);
        yield MenuItem::linkToCrud('Fiches Partenaires', 'fa fa-address-book', FichePartenaire::class);
        yield MenuItem::linkToCrud('Cartes', 'fa fa-th', Carte::class);
        yield MenuItem::linkToCrud('Cepages', 'fa fa-glass', Cepage::class);
        yield MenuItem::linkToCrud('Crus', 'fa fa-glass', Crus::class);
    }
}
