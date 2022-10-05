<?php

namespace App\Controller\Admin;

use App\Entity\CotisationType;
use App\Entity\FiscalYear;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    public function __construct(private AdminUrlGenerator $adminUrlGenerator)
    {

    }

    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        $url = $this->adminUrlGenerator->setController(CotisationCrudController::class)->generateUrl();

        return $this->redirect($url);
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Salsassoc');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::section('Dashboard', 'fa fa-home');

        yield MenuItem::section('Members');
        yield MenuItem::section('Memberships');
        yield MenuItem::section('Accounting');

        yield MenuItem::section('Settings');
        yield MenuItem::subMenu('Fiscal years', 'fas fa-bars')->setSubItems([
            MenuItem::linkToCrud('Add fiscal year', 'fas fa-plus', FiscalYear::class)->setAction(Crud::PAGE_NEW),
            MenuItem::linkToCrud('Show fiscal years', 'fas fa-eye', FiscalYear::class)
        ]);
        yield MenuItem::subMenu('Cotisation type', 'fas fa-gear')->setSubItems([
            MenuItem::linkToCrud('Add cotisation type', 'fas fa-plus', CotisationType::class)->setAction(Crud::PAGE_NEW),
            MenuItem::linkToCrud('Show cotisation type', 'fas fa-eye', CotisationType::class)
        ]);
    }
}
