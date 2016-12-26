<?php

namespace AppBundle\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * Ville
 *
 * @ORM\Table(name="ville")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\VilleRepository")
 *
 * @ApiResource(attributes={
 *     "normalization_context"={"groups"={"user", "read"}},
 *     "denormalization_context"={"groups"={"user", "write"}}
 * })
 */
class Ville
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
     * @Groups({"read", "write"})
     * @ORM\Column(name="nom", type="string", length=255, unique=true)
     */
    private $nom;

    /**
     * @ORM\ManyToOne(
     *     targetEntity="Pays",
     *     inversedBy="villes",
     *     cascade={"persist"}
     * )
     * @ORM\JoinColumn(name="pays_id", referencedColumnName="id")
     * @Groups({"read", "write"})
     */
    private $pays;

    /**
     * @return mixed
     */
    public function getPays()
    {
        return $this->pays;
    }

    /**
     * @param mixed $pays
     * @return Ville
     */
    public function setPays($pays)
    {
        $this->pays = $pays;
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
     * @return Ville
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

