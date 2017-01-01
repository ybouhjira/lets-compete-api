<?php

namespace AppBundle\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
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
     * @var ArrayCollection Les solutions écrite par le participants
     *
     * @ORM\OneToMany(
     *     targetEntity="Solution",
     *     mappedBy="participant",
     *     cascade={"persist"}
     * )
     */
    private $solutions;

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
        $this->solutions = new ArrayCollection();
    }

    public function getNomAffiche() : string
    {
        return $this->getFirstName() . ' ' . $this->getLastName();
    }

    /**
     * Les solutions du participants
     */
    public function getSolutions() : ArrayCollection
    {
        return $this->solutions;
    }

    /**
     * Add solution
     *
     * @param \AppBundle\Entity\Solution $solution
     *
     * @return Participant
     */
    public function addSolution(\AppBundle\Entity\Solution $solution)
    {
        $this->solutions[] = $solution;

        return $this;
    }

    /**
     * Remove solution
     *
     * @param \AppBundle\Entity\Solution $solution
     */
    public function removeSolution(\AppBundle\Entity\Solution $solution)
    {
        $this->solutions->removeElement($solution);
    }
}
