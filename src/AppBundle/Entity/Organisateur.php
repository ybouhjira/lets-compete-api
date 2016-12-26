<?php

namespace AppBundle\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * Organisateur
 *
 * @ORM\Table(uniqueConstraints={
 *     @ORM\UniqueConstraint(name="uniq_nom", columns={"nom"})
 * })
 * @ORM\Entity(repositoryClass="AppBundle\Repository\OrganiserRepository")
 * @ApiResource(attributes={
 *     "normalization_context"={"groups"={"read"}},
 *     "denormalization_context"={"groups"={"write"}}
 * })
 */
class Organisateur extends Membre
{
    /**
     * @ORM\OneToMany(
     *     targetEntity="Competition",
     *     mappedBy="organisateur",
     *     cascade={"persist"}
     * )
     */
    private $competitions;

    /**
     * @Groups({"read", "write"})
     * @ORM\Column(type="string", length=255, nullable=false)
     */
    private $nom;

    public function __construct()
    {
        parent::__construct();
        $this->competitions = new ArrayCollection();
        $this->addRole('ROLE_ORGANISATEUR');
    }

    public function addCompetition(Competition $competition)
    {
        $this->competitions->add($competition);
        $competition->setOrganisateur($this);
        return $this;
    }

    public function removeCompetition(Competition $competition)
    {
        $this->competitions->remove($competition);
        return $this;
    }

    public function getCompetitions()
    {
        return $this->competitions;
    }

    public function getNomAffiche() : string
    {
        return $this->getNom();
    }

    /**
     * @return mixed
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * @param mixed $nom
     * @return Organisateur
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
        return $this;
    }
}

