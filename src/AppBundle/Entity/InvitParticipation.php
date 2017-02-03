<?php
namespace AppBundle\Entity;

/**
 * InvitParticipation
 */
class InvitParticipation
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var boolean
     */
    private $accepte;

    /**
     * @var \DateTime
     */
    private $dateTime;

    /**
     * Le participant
     * @var Participant
     */
    private $participant;

    /**
     * La compétition concernée
     * @var Competition
     */
    private $competition;

    public function __construct()
    {
        $this->dateTime = new \DateTime('now');
    }

    /**
     * Set accepte
     *
     * @param boolean $accepte
     *
     * @return InvitParticipation
     */
    public function setAccepte($accepte)
    {
        $this->accepte = $accepte;
        return $this;
    }

    /**
     * Getter
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
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
    public function getParticipant() : Participant
    {
        return $this->participant;
    }
    /**
     * @param Participant $participant
     * @return InvitParticipation
     */
    public function setParticipant(Participant $participant)
    {
        $this->participant = $participant;
        return $this;
    }

    /**
     * @return Competition
     */
    public function getCompetition() : Competition
    {
        return $this->competition;
    }

    /**
     * @param Competition $competition
     * @return InvitParticipation
     */
    public function setCompetition(Competition $competition)
    {
        $this->competition = $competition;
        return $this;
    }
}
