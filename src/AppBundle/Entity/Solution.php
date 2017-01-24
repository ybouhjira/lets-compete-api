<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

use Symfony\Component\Serializer\Annotation\Groups;

/**
 * Solution
 *
 *
 */
class Solution
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var \DateTime
     */
    private $tempsEnvoie;

    /**
     * @var int
     */
    private $tempsExécution;

    /**
     * Les fichier contenant le code
     * @var FichierCode
     */
    private $fichiersCode;

    /**
     * L'auteur
     * @var Participant
     */
    private $participant;

    /**
     * Le langage de la solution
     * @var Langage
     */
    private $langage;

    /**
     * @var boolean
     */
    private $correcte;

    /**
     * Le problème au quel la solution répond
     * @var Probleme
     */
    private $probleme;

    /**
     * @return Probleme
     */
    public function getProbleme() : Probleme
    {
        return $this->probleme;
    }

    /**
     * @param Probleme $probleme
     * @return Solution
     */
    public function setProbleme($probleme) : self
    {
        $this->probleme = $probleme;
        return $this;
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
     * @return Solution
     */
    public function setParticipant($participant)
    {
        $this->participant = $participant;
        return $this;
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
     * Get tempsEnvoie
     *
     * @return \DateTime
     */
    public function getTempsEnvoie()
    {
        return $this->tempsEnvoie;
    }

    /**
     * Set tempsExécution
     *
     * @param integer $tempsExécution
     *
     * @return Solution
     */
    public function setTempsExécution($tempsExécution)
    {
        $this->tempsExécution = $tempsExécution;

        return $this;
    }

    /**
     * Get tempsExécution
     *
     * @return int
     */
    public function getTempsExécution()
    {
        return $this->tempsExécution;
    }

    /**
     * Set correcte
     *
     * @param boolean $correcte
     *
     * @return Solution
     */
    public function setCorrecte($correcte)
    {
        $this->correcte = $correcte;

        return $this;
    }

    /**
     * Get correcte
     *
     * @return bool
     */
    public function getCorrecte()
    {
        return $this->correcte;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->fichiersCode = new ArrayCollection();
        $this->tempsEnvoie = new \DateTime('now');
    }

    /**
     * Add fichiersCode
     *
     * @param FichierCode $fichierCode
     * @return Solution
     */
    public function addFichierCode(FichierCode $fichierCode) : self
    {
        $this->fichiersCode[] = $fichierCode;
        return $this;
    }

    /**
     * Remove fichiersCode
     *
     * @param \AppBundle\Entity\FichierCode $fichierCode
     * @return Solution $this
     */
    public function removeFichierCode(FichierCode $fichierCode) : self
    {
        $this->fichiersCode->removeElement($fichierCode);
        return $this;
    }

    /**
     * Get fichiersCode
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getFichiersCode() : Collection
    {
        return $this->fichiersCode;
    }

    /**
     * @return Langage
     */
    public function getLangage()
    {
        return $this->langage;
    }

    /**
     * @param Langage $langage
     * @return Solution
     */
    public function setLangage($langage)
    {
        $this->langage = $langage;
        return $this;
    }
}
