<?php

namespace App\Controller\Admin;

use App\Entity\Member;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;

class MemberCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Member::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('lastname'),
            TextField::new('firstname'),
            ChoiceField::new('gender')->setChoices([
                'Unknown' => 0,
                'Male' => 1,
                'Female' => 2,
            ]),
            DateField::new('birthdate'),
            TextField::new('address'),
            IntegerField::new('zipcode'),
            TextField::new('city'),
            EmailField::new('email'),
            TextField::new('phonenumber'),
            TextField::new('phonenumber2'),
            BooleanField::new('isMember'),
            BooleanField::new('allowImageRights'),
            TextEditorField::new('comments')->hideOnIndex(),
            DateTimeField::new('createdAt')->hideOnForm()->hideOnIndex(),
            DateTimeField::new('updatedAt')->hideOnForm()->hideOnIndex(),
        ];
    }

    public function updateEntity(EntityManagerInterface $em, $entityInstance): void
    {
        if(!$entityInstance instanceof Member) return;

        $dateNow = new \DateTimeImmutable;
        $entityInstance->setUpdatedAt($dateNow);
        parent::persistEntity($em, $entityInstance);
    }

    public function persistEntity(EntityManagerInterface $em, $entityInstance): void
    {
        if(!$entityInstance instanceof Member) return;

        $dateNow = new \DateTimeImmutable;
        $entityInstance->setCreatedAt($dateNow);
        $entityInstance->setUpdatedAt($dateNow);
        parent::persistEntity($em, $entityInstance);
    }
}
