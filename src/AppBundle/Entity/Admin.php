<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Admin
 * @ORM\Entity(repositoryClass="AppBundle\Repository\AdminRepository")
 */
class Admin extends User
{
    public function __construct()
    {
        parent::__construct();
        $this->addRole('ROLE_ADMIN');
    }
}

