<?php

namespace AppBundle\Entity;


use Symfony\Component\Serializer\Annotation\Groups;

/**
 * DemandeParticipation
 */
class DemandeParticipation
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var bool
     */
    private $accepte;

    /**
     * @var \DateTime
     */
    private $date;

    /**
     * @var Competition
     */
    private $competition;

    /**
     * @var Participant
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

