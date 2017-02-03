<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\HttpFoundation\File\File;

/**
 * Solution
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
    private $updatedAt;

    /**
     * @var File
     */
    private $fichierZip;

    /**
     * @var \DateTime
     */
    private $tempsEnvoie;

    /**
     * @var string
     */
    private $cheminZip;

    /**
     * @var int
     */
    private $tempsExecution;

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
    public function getProbleme()
    {
        return $this->probleme;
    }

    /**
     * @param Probleme $probleme
     * @return Solution
     */
    public function setProbleme($probleme)
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
     * @param integer $tempsExecution
     *
     * @return Solution
     */
    public function setTempsExecution($tempsExecution)
    {
        $this->tempsExecution = $tempsExecution;

        return $this;
    }

    /**
     * Get tempsExécution
     *
     * @return int
     */
    public function getTempsExecution()
    {
        return $this->tempsExecution;
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
    public function addFichierCode(FichierCode $fichierCode)
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
    public function removeFichierCode(FichierCode $fichierCode)
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

    /**
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * @param \DateTime $updatedAt
     * @return Solution
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }

    /**
     * @return File
     */
    public function getFichierZip()
    {
        return $this->fichierZip;
    }

    /**
     * @param File $fichierZip
     * @return Solution
     */
    public function setFichierZip(File $fichierZip = null)
    {
        $this->fichierZip = $fichierZip;

        // It is required that at least one field changes if you
        // are using doctrine otherwise the event listeners won't
        // be called and the file is lost
        if ($fichierZip)
            $this->updatedAt = new \DateTimeImmutable();

        return $this;
    }

    /**
     * @return string
     */
    public function getCheminZip()
    {
        return $this->cheminZip;
    }

    /**
     * @param string $cheminZip
     * @return Solution
     */
    public function setCheminZip($cheminZip)
    {
        $this->cheminZip = $cheminZip;
        return $this;
    }
}
