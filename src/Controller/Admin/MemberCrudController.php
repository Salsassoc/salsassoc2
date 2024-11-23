<?php

namespace App\Controller\Admin;

use App\Entity\Member;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\QueryBuilder;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
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
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Dto\SearchDto;
use EasyCorp\Bundle\EasyAdminBundle\Dto\EntityDto;
use EasyCorp\Bundle\EasyAdminBundle\Collection\FieldCollection;
use EasyCorp\Bundle\EasyAdminBundle\Collection\FilterCollection;
use function Symfony\Component\Translation\t;

class MemberCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Member::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular(t('entity.member.label'))
            ->setEntityLabelInPlural(t('entity.member.label_plural'))
            ->overrideTemplates([
                'crud/edit' => 'admin/member_edit.html.twig',
            ]);
        ;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id', t('entity.member.fields.id'))->hideOnForm(),
            TextField::new('lastname', t('entity.member.fields.lastname')),
            TextField::new('firstname', t('entity.member.fields.firstname')),
            ChoiceField::new('gender', t('entity.member.fields.gender'))->setTranslatableChoices([
                0 => t('entity.gender.unknown'),
                1 => t('entity.gender.male'),
                2 => t('entity.gender.female'),
            ]),
            DateField::new('birthdate', t('entity.member.fields.birthdate')),
            TextField::new('address', t('entity.member.fields.address')),
            IntegerField::new('zipcode', t('entity.member.fields.zipcode')),
            TextField::new('city', t('entity.member.fields.city')),
            EmailField::new('email', t('entity.member.fields.email')),
            TextField::new('phonenumber', t('entity.member.fields.phonenumber')),
            TextField::new('phonenumber2', t('entity.member.fields.phonenumber2'))->hideOnIndex(),
            BooleanField::new('isMember', t('entity.member.fields.ismember'))->hideOnIndex(),
            BooleanField::new('allowImageRights', t('entity.member.fields.allowimagerights'))
                ->renderAsSwitch($pageName === Crud::PAGE_INDEX ? false : true),
            TextEditorField::new('comments', t('entity.member.fields.comments'))->hideOnIndex(),
            DateTimeField::new('createdAt', t('entity.member.fields.createdat'))->hideOnForm()->hideOnIndex(),
            DateTimeField::new('updatedAt', t('entity.member.fields.updatedat'))->hideOnForm()->hideOnIndex(),
            //AssociationField::new('memberships', t('entity.member.fields.memberships')),
        ];
    }

    public function createIndexQueryBuilder(SearchDto $searchDto, EntityDto $entityDto, FieldCollection $fields, FilterCollection $filters): QueryBuilder
    {
        $queryBuilder = parent::createIndexQueryBuilder($searchDto, $entityDto, $fields, $filters);

        // if user defined sort is not set
        if (0 === count($searchDto->getSort())) {
            $queryBuilder
                ->addSelect('CONCAT(entity.lastname, \' \', entity.firstname) AS HIDDEN full_name')
                ->addOrderBy('full_name', 'ASC');
        }

        return $queryBuilder;
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
