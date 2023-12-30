<?php

namespace App\DataFixtures;

use App\Entity\Admin;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\MigratingPasswordHasher;

class AdminFixture extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $admin = new Admin();

        $admin->setUsername('admin');
        $admin->setPassword('admin');
        $admin->setRoles(["ROLE_ADMIN"]);

        $manager->persist($admin);
        $manager->flush();
    }

}