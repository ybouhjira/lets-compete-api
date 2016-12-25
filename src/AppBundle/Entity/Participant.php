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

    /**
     * @ORM\Column(type="string", length=255, nullable=false)
     */
    private $firstName;

    /**
     * @ORM\Column(type="string", length=255, nullable=false)
     */
    private $lastName;

    /**
     * @return mixed
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @param mixed $firstName
     * @return Participant
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @param mixed $lastName
     * @return Participant
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
        return $this;
    }

    public function __construct()
    {
        parent::__construct();
        $this->addRole('ROLE_PROGRAMER');
    }

    public function getNomAffiche() : string
    {
        return $this->getFirstName() . ' ' . $this->getLastName();
    }
}

