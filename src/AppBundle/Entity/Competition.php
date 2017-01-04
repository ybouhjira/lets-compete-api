<?php

namespace AppBundle\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints\Date;
use Symfony\Component\Validator\Constraints\DateTime;

/**
 * Competition
 *
 * @ORM\Table(name="competition")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CompetitionRepository")
 */
class Competition
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\OneToMany(targetEntity="Probleme", mappedBy="competition")
     */
    private $problemes;

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
     * @var string
     *
     * @Groups({"read", "write"})
     * @ORM\Column(type="string", length=255)
     */
    private $titre;

    /**
     * @var string
     * @Groups({"read", "write"})
     * @ORM\Column(type="text")
     */
    private $description;


    /**
     * @ORM\Column(type="datetime", nullable=false)
     * @Groups({"read", "write"})
     */
    private $tempsDebut;

    /**
     * @ORM\Column(type="datetime", nullable=false)
     * @Groups({"read", "write"})
     */
    private $tempsFin;

    /**
     * @ORM\Column(type="boolean")
     * @Groups({"read", "write"})
     */
    private $public;

    /**
     * @ORM\Column(type="boolean")
     * @Groups({"read", "write"})
     */
    private $publie;

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

    /**
     * @var Organisateur
     * Groups({"read", "write"})
     * @ORM\JoinColumn(name="organiser_id", referencedColumnName="id", nullable=false)
     * @ORM\ManyToOne(targetEntity="Organisateur", inversedBy="competitions")
     */
    private $organisateur;

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
}

