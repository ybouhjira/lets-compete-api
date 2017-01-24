<?php

namespace AppBundle\Entity;

/**
 * FichierCode
 */
class FichierCode
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $contenu;

    /**
     * @var Solution la solution
     */
    private $solution;

    /**
     * @return Solution
     */
    public function getSolution()
    {
        return $this->solution;
    }

    /**
     * @param Solution $solution
     * @return FichierCode
     */
    public function setSolution($solution)
    {
        $this->solution = $solution;
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
     * Set contenu
     * @param string $contenu
     * @return FichierCode
     */
    public function setContenu($contenu)
    {
        $this->contenu = $contenu;

        return $this;
    }

    /**
     * Get contenu
     * @return string
     */
    public function getContenu()
    {
        return $this->contenu;
    }
}

