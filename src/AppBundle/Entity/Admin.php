<?php

namespace AppBundle\Entity;

/**
 * Admin
 */
class Admin extends Utilisateur
{
    public function __construct()
    {
        parent::__construct();
        $this->addRole('ROLE_ADMIN');
    }
}

