<?php

namespace App\Controller\Admin;

use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\{Crud, KeyValueStore};
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\{IdField, EmailField, TextField};
use Symfony\Component\Form\Extension\Core\Type\{PasswordType, RepeatedType};
use Symfony\Component\Form\{FormBuilderInterface, FormEvent, FormEvents};
use function Symfony\Component\Translation\t;

use EasyCorp\Bundle\EasyAdminBundle\Context\AdminContext;
use EasyCorp\Bundle\EasyAdminBundle\Dto\EntityDto;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserCrudController extends AbstractCrudController
{
    private UserPasswordHasherInterface $hasher;

    public function __construct(public UserPasswordHasherInterface $userPasswordHasher) {
        $this->hasher = $userPasswordHasher;
    }

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

    public function createNewFormBuilder( 
        EntityDto $entityDto, 
        KeyValueStore $formOptions, 
        AdminContext $context 
    ): FormBuilderInterface {
        $formBuilder = parent::createNewFormBuilder( $entityDto, $formOptions, $context );
        $this->addEncodePasswordEventListener( $formBuilder );
        return $formBuilder;
    }

    public function createEditFormBuilder( 
        EntityDto $entityDto, 
        KeyValueStore $formOptions, 
        AdminContext $context 
    ): FormBuilderInterface {
        $formBuilder   = parent::createEditFormBuilder( $entityDto, $formOptions, $context );
        $this->addEncodePasswordEventListener( $formBuilder);
        return $formBuilder;
    }

    protected function addEncodePasswordEventListener( 
        FormBuilderInterface $formBuilder
    ): void {
        $formBuilder->addEventListener( 
            FormEvents::SUBMIT, 
            function ( FormEvent $event ) {
                $user = $event->getData();
                $plainPassword = $user->getPassword();
                if ($plainPassword != null) {
                    $user->setPassword( $this->hasher->hashPassword( $user, $plainPassword ) );
                    //$this->get('session')->getFlashBag()->add('success', 'Updated password');
                }
            } 
        );
    }
}
