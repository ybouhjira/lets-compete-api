<?php

namespace AppBundle\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * Pays
 *
 * @ORM\Table(name="pays")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PaysRepository")
 *
 * @ApiResource(attributes={
 *     "normalization_context"={"groups"={"user", "read"}},
 *     "denormalization_context"={"groups"={"user", "write"}}
 * })
 */
class Pays
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
     * @ORM\Column(name="nom", type="string", length=255, unique=true)
     */
    private $nom;

    /**
     * @ORM\OneToMany(targetEntity="Ville", mappedBy="pays")
     */
    private $villes;

    public function __construct()
    {
        $this->villes = new ArrayCollection();
    }

    public function getVilles()
    {
        return $this->villes;
    }

    public function addVille(Ville $ville)
    {
        $this->villes->add($ville);
        return $this;
    }

    public function removeVille(Ville $ville)
    {
        $this->villes->remove($ville);
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
     * Set nom
     *
     * @param string $nom
     *
     * @return Pays
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
}

