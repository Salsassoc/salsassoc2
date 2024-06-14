<?php

namespace App\Controller\Admin;

use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use Symfony\Component\Form\Extension\Core\Type\{PasswordType, RepeatedType};
use function Symfony\Component\Translation\t;

class UserCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return User::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular(t('entity.user.label'))
            ->setEntityLabelInPlural(t('entity.user.label_plural'))
        ;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id', t('entity.user.fields.id'))->hideOnForm(),
            EmailField::new('email', t('entity.user.fields.email')),
            TextField::new('title', t('entity.user.fields.password'))
                ->setFormType(RepeatedType::class)
                ->setFormTypeOptions([
                    'type' => PasswordType::class,
                    'first_options' => ['label' => t('entity.user.fields.password')],
                    'second_options' => ['label' => t('entity.user.fields.password.confirm')],
                    'mapped' => false,
                ])
            ->setRequired($pageName === Crud::PAGE_NEW)
            ->onlyOnForms(),
        ];
    }
}
