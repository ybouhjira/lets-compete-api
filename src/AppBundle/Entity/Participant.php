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
     * @Groups({"read"})
     */
    private $prenom;

    /**
     * @ORM\Column(type="string", length=255, nullable=false)
     * @Groups({"read"})
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
}
