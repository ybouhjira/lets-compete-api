<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * Programer
 *
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ParticipantRepository")
 */
class Participant extends Membre
{

    /**
     * @ORM\Column(type="string", length=255, nullable=false)
     * @Groups({"read", "write", "invit-read", "brief"})
     */
    private $prenom;

    /**
     * @ORM\Column(type="string", length=255, nullable=false)
     * @Groups({"read", "write", "invit-read", "brief"})
     */
    private $nom;

    /**
     * @var ArrayCollection Les solutions écrite par le participants
     *
     * @ORM\OneToMany(
     *     targetEntity="Solution",
     *     mappedBy="participant",
     *     cascade={"persist"}
     * )
     */
    private $solutions;

    /**
     * Les invitations à participer
     * @var ArrayCollection
     * @ORM\OneToMany(
     *     targetEntity="InvitParticipation",
     *     cascade={"persist"},
     *     mappedBy="participant"
     * )
     */
    private $invitParticipations;

    /**
     * Les demandes de participation
     * @var ArrayCollection
     * @ORM\OneToMany(
     *     targetEntity="DemandeParticipation",
     *     cascade={"persist"},
     *     mappedBy="participant"
     * )
     */
    private $demandeParticipations;

    /**
     * @Groups({"read"})
     * @return string
     */
    public function getSolutionsList()
    {
        return 'participants/' . $this->getId() . '/solutions';
    }

    /**
     * @return mixed
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * @param mixed $prenom
     * @return Participant
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * @param mixed $nom
     * @return Participant
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
        return $this;
    }

    public function __construct()
    {
        parent::__construct();
        $this->addRole('ROLE_PROGRAMER');
        $this->solutions = new ArrayCollection();
    }

    public function getNomAffiche() : string
    {
        return $this->getPrenom() . ' ' . $this->getNom();
    }

    /**
     * @Groups({"read"})
     * @return string
     */
    public function getInvitParticipationsList() : string
    {
        return '/participants/' . $this->getId() . '/invit_participations';
    }

    /**
     * Les solutions du participants
     */
    public function getSolutions() : ArrayCollection
    {
        return $this->solutions;
    }

    /**
     * Add solution
     *
     * @param \AppBundle\Entity\Solution $solution
     *
     * @return Participant
     */
    public function addSolution(\AppBundle\Entity\Solution $solution)
    {
        $this->solutions[] = $solution;

        return $this;
    }

    /**
     * Remove solution
     *
     * @param \AppBundle\Entity\Solution $solution
     */
    public function removeSolution(\AppBundle\Entity\Solution $solution)
    {
        $this->solutions->removeElement($solution);
    }

    /**
     * Add invitParticipation
     *
     * @param \AppBundle\Entity\InvitParticipation $invitParticipation
     *
     * @return Participant
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
