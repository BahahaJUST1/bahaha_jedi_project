<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class UserFixture extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $user = new User();
        $user->setEmail("root@gmail.com");
        $user->setPassword('$2y$13$URGGMjpAApga97tcOlCxEOFOUkwOUOPhlXnXss4WvXD3KYSg0apym');
        $user->setRoles(["ROLE_ADMIN"]);
        $manager->persist($user);

        $manager->flush();
    }
}
