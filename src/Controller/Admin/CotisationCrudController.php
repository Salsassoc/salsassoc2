<?php

namespace App\Controller\Admin;

use App\Entity\Cotisation;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;

class CotisationCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Cotisation::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('label'),
            AssociationField::new('cotisationType'),
            MoneyField::new('amount')->setCurrency('EUR')->setStoredAsCents(false),
            DateField::new('startDate'),
            DateField::new('endDate'),
            AssociationField::new('fiscalYear'),
        ];
    }
}
