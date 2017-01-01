<?php

namespace AppBundle\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * Un problème un compétition
 *
 * @ORM\Table(name="probleme")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ProblemeRepository")
 * @ApiResource
 */
class Probleme
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
     * @Groups({"read", "write"})
     * @ORM\Column(name="enonce", type="text")
     */
    private $enonce;

    /**
     * @var Competition La compétition à laquelle appartient le problème.
     * @ORM\ManyToOne(targetEntity="Competition", inversedBy="problemes")
     * @ORM\JoinColumn(name="compeititon_id", referencedColumnName="id", onDelete="CASCADE")
     */
    private $competition;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(
     *     targetEntity="Solution",
     *     cascade={"persist"},
     *     mappedBy="probleme"
     * )
     */
    private $solutions;

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
     * @return mixed
     */
    public function getCompetition()
    {
        return $this->competition;
    }

    /**
     * @param mixed $competition
     * @return Probleme
     */
    public function setCompetition($competition)
    {
        $this->competition = $competition;
        return $this;
    }

    /**
     * Set enonce
     *
     * @param string $enonce
     *
     * @return Probleme
     */
    public function setEnonce($enonce)
    {
        $this->enonce = $enonce;

        return $this;
    }

    /**
     * Get enonce
     *
     * @return string
     */
    public function getEnonce()
    {
        return $this->enonce;
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->solutions = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add solution
     *
     * @param \AppBundle\Entity\Solution $solution
     *
     * @return Probleme
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
     * Get solutions
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSolutions()
    {
        return $this->solutions;
    }
}
