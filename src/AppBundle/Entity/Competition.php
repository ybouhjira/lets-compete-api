<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
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
     * @ORM\OneToMany(targetEntity="Probleme", mappedBy="competition", cascade={"persist"})
     */
    private $problemes;

    /**
     * @var
     * @Groups({"comp-read"})
     * @ORM\ManyToMany(
     *     targetEntity="Langage",
     *     cascade={"persist"},
     *     inversedBy="competitions"
     * )
     */
    private $langages;

    /**
     * Les demandes de participation
     * @var ArrayCollection
     * @Groups({"comp-read"})
     * @ORM\OneToMany(
     *     targetEntity="DemandeParticipation",
     *     cascade={"persist"},
     *     mappedBy="competition"
     * )
     */
    private $demandeParticipations;

    /**
     * Les invitations à participer
     * @var ArrayCollection
     * @Groups({"comp-read"})
     * @ORM\OneToMany(
     *     targetEntity="InvitParticipation",
     *     cascade={"persist"},
     *     mappedBy="competition"
     * )
     */
    private $invitParticipations;

    /**
     * @var string
     *
     * @Groups({"comp-read", "write", "invit-read", "brief"})
     * @ORM\Column(type="string", length=255)
     */
    private $titre;

    /**
     * @var string
     * @Groups({"comp-read", "write"})
     * @ORM\Column(type="text")
     */
    private $description;


    /**
     * @ORM\Column(type="datetime", nullable=false)
     * @Groups({"comp-read", "write"})
     */
    private $tempsDebut;

    /**
     * @var Organisateur
     * @Groups({"comp-read", "write"
     * })
     * @ORM\JoinColumn(name="organiser_id", referencedColumnName="id", nullable=false)
     * @ORM\ManyToOne(targetEntity="Organisateur", inversedBy="competitions")
     */
    private $organisateur;

    /**
     * @ORM\Column(type="datetime", nullable=false)
     * @Groups({"comp-read", "write"})
     */
    private $tempsFin;

    /**
     * @ORM\Column(type="boolean")
     * @Groups({"comp-read", "write"})
     */
    private $public;

    /**
     * @ORM\Column(type="boolean")
     * @Groups({"comp-read", "write"})
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
     * @param \AppBundle\Entity\Langage $langage
     *
     * @return Competition
     */
    public function addLangage(\AppBundle\Entity\Langage $langage)
    {
        $this->langages[] = $langage;

        return $this;
    }

    /**
     * Remove langage
     *
     * @param \AppBundle\Entity\Langage $langage
     */
    public function removeLangage(\AppBundle\Entity\Langage $langage)
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
     * Add invitParticipation
     *
     * @param \AppBundle\Entity\InvitParticipation $invitParticipation
     *
     * @return Competition
     */
    public function addInvitParticipation(\AppBundle\Entity\InvitParticipation $invitParticipation)
    {
        $this->invitParticipations[] = $invitParticipation;

        return $this;
    }

    /**
     * Remove invitParticipation
     *
     * @param \AppBundle\Entity\InvitParticipation $invitParticipation
     */
    public function removeInvitParticipation(\AppBundle\Entity\InvitParticipation $invitParticipation)
    {
        $this->invitParticipations->removeElement($invitParticipation);
    }

    /**
     * Get invitParticipations
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getInvitParticipations()
    {
        return $this->invitParticipations;
    }

    /**
     * Add demandeParticipation
     *
     * @param \AppBundle\Entity\DemandeParticipation $demandeParticipation
     *
     * @return Participant
     */
    public function addDemandeParticipation(\AppBundle\Entity\DemandeParticipation $demandeParticipation)
    {
        $this->demandeParticipations[] = $demandeParticipation;

        return $this;
    }

    /**
     * Remove demandeParticipation
     *
     * @param \AppBundle\Entity\DemandeParticipation $demandeParticipation
     */
    public function removeDemandeParticipation(\AppBundle\Entity\DemandeParticipation $demandeParticipation)
    {
        $this->demandeParticipations->removeElement($demandeParticipation);
    }

    /**
     * Get demandeParticipations
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getDemandeParticipations()
    {
        return $this->demandeParticipations;
    }
}
