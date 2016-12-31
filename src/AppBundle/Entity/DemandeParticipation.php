<?php

namespace AppBundle\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * DemandeParticipation
 *
 * @ORM\Table(name="demande_participation")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\DemandeParticipationRepository")
 * @ApiResource()
 */
class DemandeParticipation
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var bool
     *
     * @ORM\Column(name="accepte", type="boolean", nullable=true)
     */
    private $accepte;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set accepte
     *
     * @param boolean $accepte
     *
     * @return DemandeParticipation
     */
    public function setAccepte($accepte)
    {
        $this->accepte = $accepte;

        return $this;
    }

    /**
     * Get accepte
     *
     * @return bool
     */
    public function getAccepte()
    {
        return $this->accepte;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return DemandeParticipation
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }
}

