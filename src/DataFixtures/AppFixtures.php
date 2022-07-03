<?php

declare(strict_types=1);

namespace App\DataFixtures;

use App\Entity\Role;
use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    public function __construct(
        private UserPasswordHasherInterface $passwordHasher
    ) {
    }

    public function load(ObjectManager $manager): void
    {
        $role = new Role();
        $role->setCode('ROLE_USER');
        $role->setLabel('Utilisateur');
        $role->setCreatedAt(new \DateTime());
        $role->setUpdatedAt(new \DateTime());

        $manager->persist($role);

        $user = new User();
        $user->setEmail('test@test.com');
        $user->setUsername('test');
        $user->setPlainPassword('test');
        $user->setCreatedAt(new \DateTime());
        $user->setUpdatedAt(new \DateTime());

        $user->setRole($role);

        $manager->persist($user);

        $manager->flush();
    }
}
