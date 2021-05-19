<?php

namespace App\Controller\Admin;

use App\Entity\Articles;
use App\Entity\Categories;
use App\Entity\Regions;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        $routeBuilder = $this->get(AdminUrlGenerator::class);

        return $this->redirect($routeBuilder->setController(ArticlesCrudController::class)->generateUrl());
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('ProjetSymfony2');
    }

    public function configureMenuItems(): iterable
    {
        return [

         MenuItem::section('Articles'),
         MenuItem::linktoDashboard('tableau de bord', 'fa fa-home'),
         MenuItem::linkToCrud('Articles', 'fas fa-list', Articles::class),
         

         MenuItem::section('criteres de recherche'),
         MenuItem::linkToCrud('Categories', 'fas fa-list', Categories::class),
         MenuItem::linkToCrud('region', 'fas fa-list', Regions::class),

         MenuItem::section('Utilisateurs'),
         MenuItem::linkToCrud('utilisteurs', 'fas fa-list', User::class),


        ];
    }
}
