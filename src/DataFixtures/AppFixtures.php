<?php

namespace App\DataFixtures;

use App\Entity\Utilisateur;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    public UserPasswordHasherInterface $userPasswordHasher;

    public function __construct(UserPasswordHasherInterface $userPasswordHasher)
    {
        $this->userPasswordHasher = $userPasswordHasher;
    }
    public function load(ObjectManager $manager): void
    {
        $admin = new Utilisateur();
        $admin->setNom('SAMINA');
        $admin->setPrenom('Angelo');
        $admin->setEmail('root@example.com');
        $admin->setTelephone('0612345678');
        $admin->setRoles(["ROLE_ADMIN"]);
        $password = $this->userPasswordHasher->hashPassword($admin,"test");
        $admin->setPassword($password);
        $manager->persist($admin);
        $manager->flush();
    }
}
