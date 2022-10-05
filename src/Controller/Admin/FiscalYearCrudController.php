<?php

namespace App\Controller\Admin;

use App\Entity\FiscalYear;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;

class FiscalYearCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return FiscalYear::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('title'),
            BooleanField::new('isCurrent'),
            DateField::new('startDate'),
            DateField::new('endDate'),
        ];
    }
}
