<?php

namespace App\Controller\Admin;

use App\Entity\CotisationType;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class CotisationTypeCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return CotisationType::class;
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
