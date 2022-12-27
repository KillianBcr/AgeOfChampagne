<?php

namespace App\Controller\Admin;

use App\Entity\Utilisateur;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class UtilisateurCrudController extends AbstractCrudController
{
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
            ArrayField::new('roles'),

            // caractéristiques du champs de mot de passe
            TextField::new('password')
            // Uniquement visible dans le formulaire
                ->hideOnIndex()
            // Non obligatoire
                ->setRequired(false)
            // Valeur vide
                ->setEmptyData('')
            // Type de champs
                ->setFormType(PasswordType::class),
            EmailField::new('email')->hideOnIndex(),
        ];
    }
}
