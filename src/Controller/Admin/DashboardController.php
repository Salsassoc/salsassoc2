<?php

namespace App\Controller\Admin;

use App\Entity\Cotisation;
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

        yield MenuItem::section('Memberships');
        yield MenuItem::linkToCrud('Members', 'fa fa-people-group', FiscalYear::class);
        yield MenuItem::linkToCrud('Memberships', 'fa fa-handshake', FiscalYear::class);
        yield MenuItem::linkToCrud('Cotisations', 'fa fa-file-contract', Cotisation::class);

        yield MenuItem::section('Accounting');

        yield MenuItem::section('Settings');
        yield MenuItem::linkToCrud('Fiscal years', 'fa fa-calendar', FiscalYear::class);
        yield MenuItem::linkToCrud('Cotisation type', 'fa fa-file-contract', CotisationType::class);
    }
}
