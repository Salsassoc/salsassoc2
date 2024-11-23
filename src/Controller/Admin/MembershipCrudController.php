<?php

namespace App\Controller\Admin;

use App\Entity\Member;
use App\Entity\Membership;
use App\Entity\MembershipCotisation;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use function Symfony\Component\Translation\t;

class MembershipCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Membership::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular(t('entity.membership.label'))
            ->setEntityLabelInPlural(t('entity.membership.label_plural'))
        ;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id', t('entity.membership.fields.id'))->hideOnForm(),
            AssociationField::new('member', t('entity.membership.fields.member'))->hideOnIndex(),
            TextField::new('lastname', t('entity.membership.fields.lastname')),
            TextField::new('firstname', t('entity.membership.fields.firstname')),
            ChoiceField::new('gender', t('entity.membership.fields.gender'))->setTranslatableChoices([
                0 => t('entity.gender.unknown'),
                1 => t('entity.gender.male'),
                2 => t('entity.gender.female'),
            ]),
            DateField::new('birthdate', t('entity.membership.fields.birthdate'))->setRequired(false)->hideOnIndex(),
            TextField::new('address', t('entity.membership.fields.address'))->setRequired(false)->hideOnIndex(),
            IntegerField::new('zipcode', t('entity.membership.fields.zipcode'))->setRequired(false)->hideOnIndex(),
            TextField::new('city', t('entity.membership.fields.city'))->setRequired(false)->hideOnIndex(),
            EmailField::new('email', t('entity.membership.fields.email'))->setRequired(false),
            TextField::new('phonenumber', t('entity.membership.fields.phonenumber'))->setRequired(false)->hideOnIndex(),
            TextField::new('phonenumber2', t('entity.membership.fields.phonenumber2'))->setRequired(false)->hideOnIndex(),
            BooleanField::new('allowImageRights', t('entity.membership.fields.allowimagerights'))->setRequired(false),
            DateField::new('membershipDate', t('entity.membership.fields.membershipdate')),
            AssociationField::new('membershipType', t('entity.membership.fields.membershiptype')),
            AssociationField::new('fiscalYear', t('entity.membership.fields.fiscalyear')),
            TextareaField::new('comments', t('entity.membership.fields.comments'))->setRequired(false)->hideOnIndex(),
            //CollectionField::new('membershipCotisations', t('entity.membership.fields.membershipcotisations'))->setEntryType(MembershipCotisation::class)->hideOnIndex(),
        ];
    }
}
