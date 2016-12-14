<?php

namespace AppBundle\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * Admin
 * @ORM\Entity(repositoryClass="AppBundle\Repository\AdminRepository")
 * @ApiResource(attributes={
 *     "normalization_context"={"groups"={"read"}},
 *     "denormalization_context"={"groups"={"write"}}
 * })
 */
class Admin extends User
{
    public function __construct()
    {
        parent::__construct();
        $this->addRole('ROLE_ADMIN');
    }
}

