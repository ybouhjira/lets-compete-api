<?php

namespace AppBundle\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Solution
 *
 * @ORM\Table(name="solution")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\SolutionRepository")
 * @ApiResource()
 */
class Solution
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
     * @var \DateTime
     *
     * @ORM\Column(name="tempsEnvoie", type="datetime")
     */
    private $tempsEnvoie;

    /**
     * @var int
     *
     * @ORM\Column(name="tempsExécution", type="integer", nullable=true)
     */
    private $tempsExécution;

    /**
     * @var FichierCode Les fichier contenant le code
     * @ORM\OneToMany(targetEntity="FichierCode", mappedBy="solution")
     */
    private $fichiersCode;

    /**
     * @var Participant L'auteur
     *
     * @ORM\ManyToOne(
     *     targetEntity="Participant",
     *     cascade={"persist"},
     *     inversedBy="solutions"
     * )
     * @ORM\JoinColumn(fieldName="participant_id", onDelete="cascade")
     */
    private $participant;

    /**
     * @var bool
     *
     * @ORM\Column(name="correcte", type="boolean", nullable=true)
     */
    private $correcte;

    /**
     * @var Probleme Le problème au quel la solution répond
     * @ORM\ManyToOne(
     *     targetEntity="Probleme",
     *     cascade={"persist"},
     *     inversedBy="solutions"
     * )
     * @ORM\JoinColumn(onDelete="CASCADE", nullable=false)
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
     * Set tempsEnvoie
     *
     * @param \DateTime $tempsEnvoie
     *
     * @return Solution
     */
    public function setTempsEnvoie($tempsEnvoie)
    {
        $this->tempsEnvoie = $tempsEnvoie;

        return $this;
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
}
