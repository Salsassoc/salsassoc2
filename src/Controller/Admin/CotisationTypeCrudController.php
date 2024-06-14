<?php

namespace App\Controller\Admin;

use App\Entity\CotisationType;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use function Symfony\Component\Translation\t;

class CotisationTypeCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return CotisationType::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular(t('entity.cotisationtype.label'))
            ->setEntityLabelInPlural(t('entity.cotisationtype.label_plural'))
        ;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id', t('entity.cotisationtype.fields.id'))->hideOnForm(),
            TextField::new('label', t('entity.cotisationtype.fields.label'))
        ];
    }
}
