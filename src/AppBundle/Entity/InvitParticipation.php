<?php

namespace AppBundle\Entity;


use Symfony\Component\Serializer\Annotation\Groups;

/**
 * InvitParticipation
 */
class InvitParticipation
{
    /**
     * @var int
     *
     *
     *
     */
    private $id;

    /**
     * @var bool
     *
     * @Groups({"read", "write", "brief"})
     *
     */
    private $accepte;

    /**
     * @var \DateTime
     *
     * @Groups({"read", "write", "brief"})
     *
     */
    private $dateTime;

    /**
     * La compétition concernée
     * @var Competition
     * @Groups({"read", "write", "invit-read"})
     *
     *
     */
    private $competition;

    public function __construct()
    {
        $this->dateTime = new \DateTime('now');
    }

    /**
     * Le participant
     * @var Participant
     * @Groups({"write", "invit-read"})
     */
    private $participant;

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

