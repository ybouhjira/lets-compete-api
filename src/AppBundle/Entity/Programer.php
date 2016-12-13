<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Programer
 *
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ProgramerRepository")
 */
class Programer extends User
{
    public function __construct()
    {
        parent::__construct();
        $this->addRole('ROLE_PROGRAMER');
    }
}

