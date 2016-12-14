<?php

namespace AppBundle\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * Programer
 *
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ProgramerRepository")
 * @ApiResource(attributes={
 *     "normalization_context"={"groups"={"read"}},
 *     "denormalization_context"={"groups"={"write"}}
 * })
 */
class Programer extends User
{
    public function __construct()
    {
        parent::__construct();
        $this->addRole('ROLE_PROGRAMER');
    }
}

