<?php

namespace App\Controller\Admin;

use App\Entity\Cotisation;
use App\Entity\CotisationType;
use App\Entity\FiscalYear;
use App\Entity\Member;
use App\Entity\Membership;
use App\Entity\MembershipType;
use App\Entity\PaymentMethod;
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
        yield MenuItem::linkToCrud('Members', 'fa fa-people-group', Member::class);
        yield MenuItem::linkToCrud('Memberships', 'fa fa-handshake', Membership::class);
        yield MenuItem::linkToCrud('Cotisations', 'fa fa-file-contract', Cotisation::class);

        yield MenuItem::section('Accounting');
        yield MenuItem::linkToCrud('Operations', 'fa fa-money-bill-transfer', FiscalYear::class);
        yield MenuItem::linkToCrud('Accounts', 'fa fa-building-columns', FiscalYear::class);
        yield MenuItem::linkToCrud('Operation categories', 'fa fa-list', CotisationType::class);

        yield MenuItem::section('Settings');
        yield MenuItem::linkToCrud('Fiscal years', 'fa fa-calendar', FiscalYear::class);
        yield MenuItem::linkToCrud('Cotisation type', 'fa fa-file-contract', CotisationType::class);
        yield MenuItem::linkToCrud('Membership type', 'fa fa-handshake', MembershipType::class);
        yield MenuItem::linkToCrud('Payment method', 'fa fa-credit-card', PaymentMethod::class);
    }
}
