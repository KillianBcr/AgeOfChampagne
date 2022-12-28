<?php

namespace App\DataFixtures;

use App\Entity\Utilisateur;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Faker\Generator;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use function Zenstruck\Foundry\faker;

class AppFixtures extends Fixture
{
    public UserPasswordHasherInterface $userPasswordHasher;
    private Generator $faker;


    public function __construct(UserPasswordHasherInterface $userPasswordHasher)
    {
        $this->userPasswordHasher = $userPasswordHasher;
        $this->faker = Factory::create('fr_FR');
    }
    public function load(ObjectManager $manager): void
    {
        $users = [];
        $admin = new Utilisateur();
        $admin->setNom('SAMINA');
        $admin->setPrenom('Angelo');
        $admin->setEmail('root@example.com');
        $admin->setTelephone('0612345678');
        $admin->setRoles(["ROLE_ADMIN"]);
        $password = $this->userPasswordHasher->hashPassword($admin,"test");
        $admin->setPassword($password);

        $users[] = $admin;
        $manager->persist($admin);

        for ($i = 0; $i < 10; $i++) {
            $domain = $this->faker->domainName;
            $user = new Utilisateur();
            $user->setNom($this->faker->lastName())
                ->setPrenom($this->faker->firstName())
                ->setEmail($user->getNom().$user->getPrenom().'@'.$domain)
                ->setTelephone($this->faker->unique()->phoneNumber())
                ->setRoles(['ROLE_USER']);
            $password = $this->userPasswordHasher->hashPassword($user,"test");
            $user->setPassword($password);
            $users[] = $user;
            $manager->persist($user);
        }
        $manager->flush();

    }
}
