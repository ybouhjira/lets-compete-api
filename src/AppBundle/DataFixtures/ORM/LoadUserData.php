<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Admin;
use AppBundle\Entity\Organiser;
use AppBundle\Entity\Programer;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadUserData implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $programer = new Programer();
        $programer
            ->setEmail('youssef@bouhjira.com')
            ->setFirstName('Youssef')
            ->setLastName('Bouhjira')
            ->setUsername('youssef')
            ->setPlainPassword('password');

        $organiser = new Organiser();
        $organiser
            ->setEmail('organiser1@gmail.com')
            ->setFirstName('OrgFirstName')
            ->setLastName('OrgLastName')
            ->setUsername('org1')
            ->setPlainPassword('password');

        $admin = new Admin();
        $admin
            ->setEmail('admin@competition.com')
            ->setFirstName('Admin')
            ->setLastName('Admin')
            ->setUsername('admin1')
            ->setPlainPassword('password');

        $manager->persist($programer);
        $manager->persist($organiser);
        $manager->flush();
    }
}