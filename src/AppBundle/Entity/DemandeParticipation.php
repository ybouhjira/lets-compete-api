<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * DemandeParticipation
 * @ORM\Table(
 *     uniqueConstraints={
 *       @ORM\UniqueConstraint(columns={"participant_id", "competition_id"})
 *     }
 * )
 * @ORM\Entity(repositoryClass="AppBundle\Repository\DemandeParticipationRepository")
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
     * @Groups({"demande-read", "write", "brief"})
     */
    private $accepte;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="datetime")
     * @Groups({"demande-read", "write", "brief"})
     */
    private $date;

    /**
     * @var Competition
     * @ORM\ManyToOne(
     *     targetEntity="Competition",
     *     cascade={"persist"},
     *     inversedBy="demandeParticipations"
     * )
     * @ORM\JoinColumn(onDelete="CASCADE")
     * @Groups({"demande-read", "write"})
     */
    private $competition;

    /**
     * @var Participant
     * @ORM\ManyToOne(
     *     targetEntity="Participant",
     *     inversedBy="demandeParticipations",
     *     cascade={"persist"}
     * )
     * @ORM\JoinColumn(onDelete="CASCADE")
     * @Groups({"demande-read", "write"})
     */
    private $participant;

    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->date = new \DateTime('now');
    }

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

    /**
     * @return Participant
     */
    public function getParticipant()
    {
        return $this->participant;
    }

    /**
     * @param Participant $participant
     * @return DemandeParticipation
     */
    public function setParticipant($participant)
    {
        $this->participant = $participant;
        return $this;
    }

    /**
     * @return Competition
     */
    public function getCompetition()
    {
        return $this->competition;
    }

    /**
     * @param Competition $competition
     * @return DemandeParticipation
     */
    public function setCompetition($competition)
    {
        $this->competition = $competition;
        return $this;
    }
}

