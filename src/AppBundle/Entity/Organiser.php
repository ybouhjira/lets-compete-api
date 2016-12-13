<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Organiser
 *
 * @ORM\Entity(repositoryClass="AppBundle\Repository\OrganizerRepository")
 */
class Organiser extends User
{
    public function __construct()
    {
        parent::__construct();
        $this->addRole('ROLE_ORGANISER');
    }
}

