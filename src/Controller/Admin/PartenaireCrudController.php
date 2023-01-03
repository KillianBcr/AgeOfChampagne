<?php

namespace App\Controller\Admin;

use App\Entity\Partenaire;
use App\Entity\Utilisateur;
use App\Repository\PartenaireRepository;
use Cassandra\Blob;
use Doctrine\DBAL\Types\BlobType;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class PartenaireCrudController extends AbstractCrudController
{
    public UserPasswordHasherInterface $userPasswordHasher;

    public function __construct(UserPasswordHasherInterface $hasher)
    {
        $this->userPasswordHasher = $hasher;
    }

    public static function getEntityFqcn(): string
    {
        return Partenaire::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('nom'),
            TextField::new('email'),
            TextField::new('telephone'),
            TextField::new('description'),
            ImageField::new('image'),
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

    public function updateEntity(EntityManagerInterface $entityManager, $entityInstance): void
    {
        parent::updateEntity($entityManager, $entityInstance); // TODO: Change the autogenerated stub
    }
}

/*
    #[IsGranted('IS_AUTHENTICATED_FULLY')]
    #[Route('/partenaire', name: 'app_partenaire')]
    public function index(PartenaireRepository $repository): Response
    {
        $partenaires = $repository->findBy([], ['nom' => 'ASC']);

        return $this->render('pages/partenaire/index.html.twig', [
            'partenaires' => $partenaires,
        ]);
    }

    #[IsGranted('IS_AUTHENTICATED_FULLY')]
    #[Route('/partenaire/{id}', name: 'app_partenaire_show',
        requirements: [
            'id' => "\d+",
        ]
    )]
    public function show(Partenaire $partenaire): Response
    {

        return $this->render('pages/partenaire/show.html.twig',
            ['partenaire' => $partenaire]);
    }
**/
