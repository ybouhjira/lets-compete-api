<?php

namespace AppBundle\Entity;

use ApiPlatform\Core\Annotation\ApiResource;

use Symfony\Component\Serializer\Annotation\Groups;

/**
 * TypeEntreeSortie
 */
class TypeEntreeSortie
{
    /**
     * @var int
     *
     *
     *
     *
     */
    private $id;

    /**
     * @var string
     *
     *
     *
     */
    private $name;

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
     * Set name
     *
     * @param string $name
     *
     * @return TypeEntreeSortie
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $entreeSorties;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->entreeSorties = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add entreeSorty
     *
     * @param \AppBundle\Entity\EntreeSortie $entreeSorty
     *
     * @return TypeEntreeSortie
     */
    public function addEntreeSorty(\AppBundle\Entity\EntreeSortie $entreeSorty)
    {
        $this->entreeSorties[] = $entreeSorty;

        return $this;
    }

    /**
     * Remove entreeSorty
     *
     * @param \AppBundle\Entity\EntreeSortie $entreeSorty
     */
    public function removeEntreeSorty(\AppBundle\Entity\EntreeSortie $entreeSorty)
    {
        $this->entreeSorties->removeElement($entreeSorty);
    }

    /**
     * Get entreeSorties
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getEntreeSorties()
    {
        return $this->entreeSorties;
    }
}
