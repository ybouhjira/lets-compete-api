<?php

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\User;

class LoadUserData implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $user = new User();
        $user->setEmail('youssef@bouhjira.com');
        $user->setFullname("Youssef Bouhjira");
        $user->setUsernameCanonical('youssef');
        $user->setUsername('youssef');
        $user->setPlainPassword('password');

        $user->addRole('ADMIN');
        $user->setSuperAdmin(true);
        $user->setEnabled(true);

        $manager->persist($user);
        $manager->flush();
    }
}