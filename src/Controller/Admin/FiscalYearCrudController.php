<?php

namespace App\Controller\Admin;

use App\Entity\FiscalYear;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use function Symfony\Component\Translation\t;

class FiscalYearCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return FiscalYear::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular(t('entity.fiscalyear.label'))
            ->setEntityLabelInPlural(t('entity.fiscalyear.label_plural'))
        ;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id', t('entity.fiscalyear.fields.id'))->hideOnForm(),
            TextField::new('title', t('entity.fiscalyear.fields.title')),
            BooleanField::new('isCurrent', t('entity.fiscalyear.fields.iscurrent')),
            DateField::new('startDate', t('entity.fiscalyear.fields.startdate')),
            DateField::new('endDate', t('entity.fiscalyear.fields.enddate')),
        ];
    }
}
