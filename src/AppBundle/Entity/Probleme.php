<?php

namespace AppBundle\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

use Symfony\Component\Serializer\Annotation\Groups;

/**
 * Un problème un compétition
 */
class Probleme
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $enonce;

    /**
     * La compétition à laquelle appartient le problème.
     * @var Competition
     */
    private $competition;

    /**
     * @var ArrayCollection
     */
    private $solutions;

    /**
     * @var string
     */
    private $titre;

    /**
     * Les d'entrée/sortie tests et exemples
     * @var EntreeSortie
     */
    private $entreeSorties;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->solutions = new ArrayCollection();
        $this->entreeSorties = new ArrayCollection();
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
     * Add solution
     *
     * @param \AppBundle\Entity\Solution $solution
     *
     * @return Probleme
     */
    public function addSolution(Solution $solution)
    {
        $this->solutions[] = $solution;

        return $this;
    }

    /**
     * Remove solution
     *
     * @param \AppBundle\Entity\Solution $solution
     */
    public function removeSolution(Solution $solution)
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

    /**
     * Add entreeSortie
     *
     * @param \AppBundle\Entity\EntreeSortie $entreeSortie
     *
     * @return Probleme
     */
    public function addEntreeSorty(EntreeSortie $entreeSortie) : self
    {
        $this->entreeSorties[] = $entreeSortie;

        return $this;
    }

    /**
     * Remove entreeSortie
     *
     * @param \AppBundle\Entity\EntreeSortie $entreeSortie
     */
    public function removeEntreeSorty(EntreeSortie $entreeSortie)
    {
        $this->entreeSorties->removeElement($entreeSortie);
    }

    /**
     * Get entreeSortie
     * @return Collection
     */
    public function getEntreeSorties()
    {
        return $this->entreeSorties;
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
     * @return Probleme
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;
        return $this;
    }


}
