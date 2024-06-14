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
use function Symfony\Component\Translation\t;

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
        yield MenuItem::section(t('menu.dashboard'), 'fa fa-home');

        yield MenuItem::section(t('menu.memberships'));
        yield MenuItem::linkToCrud(t('menu.members'), 'fa fa-people-group', Member::class);
        yield MenuItem::linkToCrud(t('menu.memberships_plural'), 'fa fa-handshake', Membership::class);
        yield MenuItem::linkToCrud(t('menu.cotisations'), 'fa fa-file-contract', Cotisation::class);

        yield MenuItem::section(t('menu.accounting'));
        yield MenuItem::linkToCrud(t('menu.operations'), 'fa fa-money-bill-transfer', FiscalYear::class);
        yield MenuItem::linkToCrud(t('menu.accounts'), 'fa fa-building-columns', FiscalYear::class);
        yield MenuItem::linkToCrud(t('menu.operation_categories'), 'fa fa-list', CotisationType::class);

        yield MenuItem::section(t('menu.settings'));
        yield MenuItem::linkToCrud(t('menu.fiscal_years'), 'fa fa-calendar', FiscalYear::class);
        yield MenuItem::linkToCrud(t('menu.cotisation_type'), 'fa fa-file-contract', CotisationType::class);
        yield MenuItem::linkToCrud(t('menu.membership_type'), 'fa fa-handshake', MembershipType::class);
        yield MenuItem::linkToCrud(t('menu.payment_method'), 'fa fa-credit-card', PaymentMethod::class);
    }
}
