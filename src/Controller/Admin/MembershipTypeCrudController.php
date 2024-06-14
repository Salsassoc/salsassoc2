<?php

namespace App\Controller\Admin;

use App\Entity\MembershipType;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use function Symfony\Component\Translation\t;

class MembershipTypeCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return MembershipType::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular(t('entity.membershiptype.label'))
            ->setEntityLabelInPlural(t('entity.membershiptype.label_plural'))
        ;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id', t('entity.membershiptype.fields.id'))->hideOnForm(),
            TextField::new('label', t('entity.membershiptype.fields.label'))
        ];
    }
}
