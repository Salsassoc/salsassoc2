<?php

namespace App\Controller\Admin;

use App\Entity\Cotisation;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use function Symfony\Component\Translation\t;

class CotisationCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Cotisation::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular(t('entity.cotisation.label'))
            ->setEntityLabelInPlural(t('entity.cotisation.label_plural'))
        ;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id', t('entity.cotisation.fields.id'))->hideOnForm(),
            TextField::new('label', t('entity.cotisation.fields.label')),
            AssociationField::new('cotisationType', t('entity.cotisation.fields.cotisationtype')),
            MoneyField::new('amount', t('entity.cotisation.fields.amount'))->setCurrency('EUR')->setStoredAsCents(false),
            DateField::new('startDate', t('entity.cotisation.fields.startdate')),
            DateField::new('endDate', t('entity.cotisation.fields.enddate')),
            AssociationField::new('fiscalYear', t('entity.cotisation.fields.fiscalyear')),
        ];
    }
}
