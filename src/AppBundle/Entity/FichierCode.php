<?php

namespace AppBundle\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * FichierCode
 *
 * @ORM\Table(name="fichier_code")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\FichierCodeRepository")
 * @ApiResource()
 */
class FichierCode
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
     * @ORM\Column(name="contenu", type="text")
     */
    private $contenu;

    /**
     * @var Solution la solution
     * @ORM\ManyToOne(
     *     targetEntity="Solution",
     *     inversedBy="fichiersCode",
     *     cascade={"persist"}
     * )
     * @ORM\JoinColumn(onDelete="CASCADE", nullable=false)
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
     *
     * @param string $contenu
     *
     * @return FichierCode
     */
    public function setContenu($contenu)
    {
        $this->contenu = $contenu;

        return $this;
    }

    /**
     * Get contenu
     *
     * @return string
     */
    public function getContenu()
    {
        return $this->contenu;
    }
}

