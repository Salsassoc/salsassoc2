<?php

namespace App\Controller\Admin;

use App\Entity\MembershipType;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class MembershipTypeCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return MembershipType::class;
    }

    /*
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }
    */
}
