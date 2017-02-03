<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints\DateTime;

/**
 * Competition
 */
class Competition
{
    /**
     * @var int
     */
    protected $id;

    /**
     * @var ArrayCollection
     */
    private $problemes;

    /**
     * @var
     */
    private $langages;

    /**
     * @var string
     */
    private $titre;

    /**
     * @var string
     */
    private $description;

    /**
     * @var \DateTime
     */
    private $tempsDebut;

    /**
     * @var Organisateur
     */
    private $organisateur;

    /**
     * @var \DateTime
     */
    private $tempsFin;

    /**
     * @var boolean
     */
    private $public;

    /**
     * @var boolean
     */
    private $publie;

    /**
     * Competition constructor.
     */
    public function __construct()
    {
        $this->problemes = new ArrayCollection();
    }

    /**
     * @return mixed
     */
    public function getProblemes()
    {
        return $this->problemes;
    }

    public function addProbleme(Probleme $probleme)
    {
        $this->problemes->add($probleme);
        return $this;
    }

    public function removeProbleme(Probleme $probleme)
    {
        $this->problemes->remove($probleme);
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTempsDebut()
    {
        return $this->tempsDebut;
    }

    /**
     * @param mixed $tempsDebut
     * @return $this
     */
    public function setTempsDebut($tempsDebut)
    {
        $this->tempsDebut = $tempsDebut;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTempsFin()
    {
        return $this->tempsFin;
    }

    /**
     * @param mixed $tempsFin
     * @return $this
     */
    public function setTempsFin($tempsFin)
    {
        $this->tempsFin = $tempsFin;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPublic()
    {
        return $this->public;
    }

    /**
     * @param mixed $public
     * @return $this
     */
    public function setPublic($public)
    {
        $this->public = $public;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPublie()
    {
        return $this->publie;
    }

    /**
     * @param mixed $publie
     * @return $this
     */
    public function setPublie($publie)
    {
        $this->publie = $publie;
        return $this;
    }

    /**
     * @return string
     */
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * @param string $titre
     * @return $this
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;
        return $this;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     * @return $this
     */
    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }


    public function setOrganisateur(Organisateur $organisateur)
    {
        $this->organisateur = $organisateur;
        return $this;
    }

    /**
     * @return Organisateur
     */
    public function getOrganisateur() : Organisateur
    {
        return $this->organisateur;
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

    public function estCommence() : bool
    {
        return $this->tempsDebut >= new DateTime();
    }

    public function estTermine() : bool
    {
        return $this->tempsFin >= new DateTime();
    }

    public function estEnCours() : bool
    {
        $now = new DateTime();
        return $this->tempsDebut >=  $now && $this->tempsFin < $now;
    }

    /**
     * Add langage
     *
     * @param Langage $langage
     *
     * @return Competition
     */
    public function addLangage(Langage $langage)
    {
        $this->langages[] = $langage;

        return $this;
    }

    /**
     * Remove langage
     *
     * @param Langage $langage
     */
    public function removeLangage(Langage $langage)
    {
        $this->langages->removeElement($langage);
    }

    /**
     * Get langages
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getLangages()
    {
        return $this->langages;
    }

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $participations;


    /**
     * Add participation
     *
     * @param \AppBundle\Entity\Participation $participation
     *
     * @return Competition
     */
    public function addParticipation(\AppBundle\Entity\Participation $participation)
    {
        $this->participations[] = $participation;

        return $this;
    }

    /**
     * Remove participation
     *
     * @param \AppBundle\Entity\Participation $participation
     */
    public function removeParticipation(\AppBundle\Entity\Participation $participation)
    {
        $this->participations->removeElement($participation);
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
