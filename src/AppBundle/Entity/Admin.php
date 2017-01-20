<?php

namespace AppBundle\Entity;

use ApiPlatform\Core\Annotation\ApiResource;


/**
 * Admin
 *
 * @ApiResource(attributes={
 *     "normalization_context"={"groups"={"read"}},
 *     "denormalization_context"={"groups"={"write"}}
 * })
 */
class Admin extends Utilisateur
{
    public function __construct()
    {
        parent::__construct();
        $this->addRole('ROLE_ADMIN');
    }
}

