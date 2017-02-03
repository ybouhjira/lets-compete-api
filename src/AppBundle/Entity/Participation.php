<?php

namespace AppBundle\Entity;

class Participation
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
    private $dateTime;

    /**
     * @var Competition
     */
    private $competition;

    /**
     * @var Participant
     */
    private $participant;

    /**
     * @var TypeParticipation
     */
    private $type;

    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->dateTime = new \DateTime('now');
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
     * @param \DateTime $dateTime
     *
     * @return DemandeParticipation
     */
    public function setDateTime($dateTime)
    {
        $this->dateTime = $dateTime;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDateTime()
    {
        return $this->dateTime;
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

    /**
     * Set type
     *
     * @param \AppBundle\Entity\participation $type
     *
     * @return Participation
     */
    public function setType(TypeParticipation $type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return \AppBundle\Entity\participation
     */
    public function getType()
    {
        return $this->type;
    }
}
