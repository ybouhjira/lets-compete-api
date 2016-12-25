<?php

namespace AppBundle\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * Programer
 *
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ParticipantRepository")
 * @ApiResource(attributes={
 *     "normalization_context"={"groups"={"read"}},
 *     "denormalization_context"={"groups"={"write"}}
 * })
 */
class Participant extends Membre
{
    public function __construct()
    {
        parent::__construct();
        $this->addRole('ROLE_PROGRAMER');
    }
}

