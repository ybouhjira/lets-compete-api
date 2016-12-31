<?php

namespace AppBundle\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * Solution
 *
 * @ORM\Table(name="solution")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\SolutionRepository")
 * @ApiResource()
 */
class Solution
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
     * @var \DateTime
     *
     * @ORM\Column(name="tempsEnvoie", type="datetime")
     */
    private $tempsEnvoie;

    /**
     * @var int
     *
     * @ORM\Column(name="tempsExécution", type="integer", nullable=true)
     */
    private $tempsExécution;

    /**
     * @var bool
     *
     * @ORM\Column(name="correcte", type="boolean", nullable=true)
     */
    private $correcte;


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
     * Set tempsEnvoie
     *
     * @param \DateTime $tempsEnvoie
     *
     * @return Solution
     */
    public function setTempsEnvoie($tempsEnvoie)
    {
        $this->tempsEnvoie = $tempsEnvoie;

        return $this;
    }

    /**
     * Get tempsEnvoie
     *
     * @return \DateTime
     */
    public function getTempsEnvoie()
    {
        return $this->tempsEnvoie;
    }

    /**
     * Set tempsExécution
     *
     * @param integer $tempsExécution
     *
     * @return Solution
     */
    public function setTempsExécution($tempsExécution)
    {
        $this->tempsExécution = $tempsExécution;

        return $this;
    }

    /**
     * Get tempsExécution
     *
     * @return int
     */
    public function getTempsExécution()
    {
        return $this->tempsExécution;
    }

    /**
     * Set correcte
     *
     * @param boolean $correcte
     *
     * @return Solution
     */
    public function setCorrecte($correcte)
    {
        $this->correcte = $correcte;

        return $this;
    }

    /**
     * Get correcte
     *
     * @return bool
     */
    public function getCorrecte()
    {
        return $this->correcte;
    }
}

