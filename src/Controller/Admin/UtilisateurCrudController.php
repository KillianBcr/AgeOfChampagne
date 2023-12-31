<?php

namespace App\Controller\Admin;

use App\Entity\Utilisateur;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UtilisateurCrudController extends AbstractCrudController
{
    public UserPasswordHasherInterface $userPasswordHasher;

    public function __construct(UserPasswordHasherInterface $hasher)
    {
        $this->userPasswordHasher = $hasher;
    }

    public static function getEntityFqcn(): string
    {
        return Utilisateur::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('nom'),
            TextField::new('prenom'),
            TextField::new('telephone'),
            ArrayField::new('roles')->hideOnIndex(),
            DateTimeField::new('created_at'),
            DateTimeField::new('update_at')->hideOnIndex(),
            // caractéristiques du champs de mot de passe
            // TextField::new('password')
            // Uniquement visible dans le formulaire
            //    ->onlyOnForms()
            // Non obligatoire
            //    ->setRequired(false)
            // Valeur vide
            //    ->setEmptyData('')
            // Autocompletion désactivé

            // Type de champs
            //    ->setFormType(PasswordType::class),
            EmailField::new('email')->hideOnForm(),
        ];
    }
}
