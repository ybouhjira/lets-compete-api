<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Admin;
use AppBundle\Entity\Competition;
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

        $competitions = array_map(function($c) {
            $newCompeition = new Competition();
            $newCompeition->setName($c);
            return $newCompeition;
        }, [
            'competition 1',
            'competition 2',
            'competition 3',
        ]);

        foreach($competitions as $competition)
            $organiser->addCompetition($competition);

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