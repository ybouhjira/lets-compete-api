<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * Langage
 *
 * @ORM\Table(name="langage")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\LangageRepository")
 */
class Langage
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
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=255, unique=true)
     * @Groups({"read", "write"})
     */
    private $nom;

    /**
     * @var
     * @ORM\ManyToMany(
     *     inversedBy="langages",
     *     targetEntity="Competition",
     *     cascade={"persist"}
     * )
     */
    private $competitions;


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
     * @return Langage
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
     * Constructor
     */
    public function __construct()
    {
        $this->competitions = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add competition
     *
     * @param \AppBundle\Entity\Competition $competition
     *
     * @return Langage
     */
    public function addCompetition(\AppBundle\Entity\Competition $competition)
    {
        $this->competitions[] = $competition;

        return $this;
    }

    /**
     * Remove competition
     *
     * @param \AppBundle\Entity\Competition $competition
     */
    public function removeCompetition(\AppBundle\Entity\Competition $competition)
    {
        $this->competitions->removeElement($competition);
    }

    /**
     * Get competitions
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCompetitions()
    {
        return $this->competitions;
    }
}
