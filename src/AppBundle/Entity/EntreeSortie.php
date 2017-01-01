<?php

namespace AppBundle\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * EntreeSortie
 *
 * @ORM\Table(name="entree_sortie")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\EntreeSortieRepository")
 * @ApiResource(attributes={
 *     "normalization_context"={"groups"={"entreeSortie"}}
 * })
 */
class EntreeSortie
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
     * @Groups({"entreeSortie"})
     * @ORM\Column(name="entree", type="text")
     */
    private $entree;

    /**
     * @var string
     * @ORM\Column(name="sortie", type="text")
     * @Groups({"entreeSortie"})
     */
    private $sortie;

    /**
     * @var TypeEntreeSortie
     * @ORM\ManyToOne(targetEntity="TypeEntreeSortie")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"entreeSortie"})
     */
    private $type;

    /**
     * @var Probleme Le problème de cet entrée/sortie
     * @ORM\ManyToOne(
     *     targetEntity="Probleme",
     *     cascade={"persist"},
     *     inversedBy="entreeSorties"
     * )
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
     *
     * @param string $entree
     *
     * @return EntreeSortie
     */
    public function setEntree($entree)
    {
        $this->entree = $entree;

        return $this;
    }

    /**
     * Get entree
     *
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

