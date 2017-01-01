<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="_type", type="string")
 *
 * @ApiResource(attributes={
 *     "normalization_context"={"groups"={"read"}},
 *     "denormalization_context"={"groups"={"write"}}
 * })
 */
abstract class Membre extends Utilisateur
{
    /**
     * @var string
     * @Groups({"read", "write"})
     * @ORM\Column(type="text", nullable=true)
     */
    private $presentation;

    /**
     * @var string
     *
     * @ORM\Column(
     *     name="telephone",
     *     type="string",
     *     length=30,
     *     nullable=true,
     *     unique=true
     * )
     */
    private $telephone;

    /**
     * @var string L'adresse de l'organisateur
     * @ORM\Column(type="string", length=255, nullable=false)
     */
    private $adresse;

    /**
     * @var Ville La ville de résidance
     *
     * @ORM\ManyToOne(
     *     targetEntity="Ville",
     *     inversedBy="membres",
     *     cascade={"persist"},
     *     fetch="EAGER"
     * )
     * @ORM\JoinColumn(fieldName="ville_id", onDelete="set null", nullable=true)
     * @Groups({"read", "write"})
     */
    private $ville;

    /**
     * @var string L'adresse de son site web
     *
     * @ORM\Column(
     *     name="siteWeb",
     *     type="string",
     *     length=255,
     *     nullable=true,
     *     unique=true
     * )
     */
    private $siteWeb;

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
     * Set presentation
     *
     * @param string $presentation
     *
     * @return Membre
     */
    public function setPresentation($presentation)
    {
        $this->presentation = $presentation;

        return $this;
    }

    /**
     * Get presentation
     *
     * @return string
     */
    public function getPresentation()
    {
        return $this->presentation;
    }

    /**
     * Set telephone
     *
     * @param string $telephone
     *
     * @return Membre
     */
    public function setTelephone($telephone)
    {
        $this->telephone = $telephone;
        return $this;
    }

    /**
     * Get telephone
     *
     * @return string
     */
    public function getTelephone()
    {
        return $this->telephone;
    }

    /**
     * Set siteWeb
     *
     * @param string $siteWeb
     *
     * @return Membre
     */
    public function setSiteWeb($siteWeb)
    {
        $this->siteWeb = $siteWeb;

        return $this;
    }

    /**
     * Get siteWeb
     *
     * @return string
     */
    public function getSiteWeb()
    {
        return $this->siteWeb;
    }

    /**
     * @return Ville
     */
    public function getVille()
    {
        return $this->ville;
    }

    /**
     * @param Ville $ville
     * @return Membre
     */
    public function setVille($ville)
    {
        $this->ville = $ville;
        return $this;
    }

    /**
     * @return string
     */
    public function getAdresse() : string
    {
        return $this->adresse;
    }

    /**
     * @param string $adresse
     * @return Membre $this
     */
    public function setAdresse($adresse) : self
    {
        $this->adresse = $adresse;
        return $this;
    }

    abstract public function getNomAffiche() : string;
}

