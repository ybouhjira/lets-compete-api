<?php

namespace AppBundle\Entity;

use ApiPlatform\Core\Annotation\ApiResource;

use Symfony\Component\Serializer\Annotation\Groups;

/**
 * EntreeSortie
 */
class EntreeSortie
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $entree;

    /**
     * @var string
     */
    private $sortie;

    /**
     * @var TypeEntreeSortie
     */
    private $type;

    /**
     * @var Probleme Le problème de cet entrée/sortie
     */
    private $probleme;

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
     * Set entree
     * @param string $entree
     * @return EntreeSortie
     */
    public function setEntree($entree)
    {
        $this->entree = $entree;

        return $this;
    }

    /**
     * Get entree
     * @return string
     */
    public function getEntree()
    {
        return $this->entree;
    }

    /**
     * Set sortie
     *
     * @param string $sortie
     *
     * @return EntreeSortie
     */
    public function setSortie($sortie)
    {
        $this->sortie = $sortie;

        return $this;
    }

    /**
     * Get sortie
     *
     * @return string
     */
    public function getSortie()
    {
        return $this->sortie;
    }

    /**
     * @return TypeEntreeSortie
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param TypeEntreeSortie $type
     * @return EntreeSortie
     */
    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @return Probleme
     */
    public function getProbleme()
    {
        return $this->probleme;
    }

    /**
     * @param Probleme $probleme
     * @return EntreeSortie
     */
    public function setProbleme($probleme)
    {
        $this->probleme = $probleme;
        return $this;
    }
}

