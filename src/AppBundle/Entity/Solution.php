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
     *
     *
     *
     */
    private $id;

    /**
     * @var \DateTime
     * @Groups({"read", "write"})
     *
     */
    private $tempsEnvoie;

    /**
     * @var int
     * @Groups({"read", "write"})
     *
     */
    private $tempsExécution;

    /**
     * @var FichierCode Les fichier contenant le code
     * @Groups({"read", "write"})
     *
     */
    private $fichiersCode;

    /**
     * L'auteur
     * @var Participant
     * @Groups({"read", "write"})
     *
     *
     */
    private $participant;

    /**
     * Le langage de la solution
     * @var Langage
     *
     *
     * @Groups({"sol-read", "write"})
     */
    private $langage;

    /**
     * @var bool
     * @Groups({"read", "write"})
     *
     */
    private $correcte;

    /**
     * @var Probleme Le problème au quel la solution répond
     *
     *
     * @Groups({"read", "write"})
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
