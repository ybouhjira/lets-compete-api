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
 *     "normalization_context"={"groups"={"read"}},
 *     "denormalization_context"={"groups"={"write"}}
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
     * @Groups({"read", "write"})
     * @ORM\Column(name="entree", type="text")
     */
    private $entree;

    /**
     * @var string
     * @Groups({"read", "write"})
     * @ORM\Column(name="sortie", type="text")
     */
    private $sortie;

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
}

