<?php

namespace App\DataFixtures;

use App\Factory\UtilisateurFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class UtilisateurFixtures extends Fixture
{
    public function load(ObjectManager $manager): \App\Entity\Utilisateur|\Zenstruck\Foundry\Proxy
    {
        $admin = UtilisateurFactory::createOne([
            'nom' => 'Boscher',
            'prenom' => 'Killian',
            'email' => 'root@example.com',
            'roles' => ['ROLE_ADMIN'],
        ]);
        return $admin;
    }
}
