<?php

namespace AppBundle\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * Ville
 *
 * @ORM\Table(name="ville")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\VilleRepository")
 *
 * @ApiResource()
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
     * @var ArrayCollection Les membres résidant dans cette ville
     *
     * @ORM\OneToMany(
     *     targetEntity="Membre",
     *     cascade={"persist"},
     *     mappedBy="ville",
     * )
     */
    private $membres;

    public function __construct()
    {
        $this->membres = new ArrayCollection();
    }

    /**
     * @return ArrayCollection
     */
    public function getMembres()
    {
        return $this->membres;
    }

    /**
     * @param Membre $membre
     * @return Ville
     */
    public function addMembre(Membre $membre)
    {
        $this->membres->add($membre);
        $membre->setVille($this);
        return $this;
    }

    /**
     * @param Membre $membre
     * @return $this
     */
    public function removeMembre(Membre $membre)
    {
        $this->membres->remove($membre);
        $membre->setVille(null);
        return $this;
    }

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

