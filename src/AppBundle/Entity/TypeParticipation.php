<?php

namespace AppBundle\Entity;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * TypeParticipation
 */
class TypeParticipation
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $nom;

    /**
     * @var ArrayCollection
     */
    private $participations;

    public function __construct()
    {
        $this->participations = new ArrayCollection();
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
     * Set nom
     *
     * @param string $nom
     *
     * @return TypeParticipation
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $participation;


    /**
     * Add participation
     *
     * @param Participation $participation
     *
     * @return TypeParticipation
     */
    public function addParticipation(Participation $participation)
    {
        $this->participation[] = $participation;

        return $this;
    }

    /**
     * Remove participation
     *
     * @param Participation $participation
     */
    public function removeParticipation(Participation $participation)
    {
        $this->participation->removeElement($participation);
    }

    /**
     * Get participation
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getParticipation()
    {
        return $this->participation;
    }

    /**
     * Get participations
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getParticipations()
    {
        return $this->participations;
    }
}
