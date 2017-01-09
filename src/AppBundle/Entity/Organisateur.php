<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * Organisateur
 * @ORM\Entity(repositoryClass="AppBundle\Repository\OrganiserRepository")
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
    protected $competitions;

    /**
     * URL de la liste des compétitions de cet organisateur.
     * @Groups({"read"})
     * @return string
     */
    public function getCompetitionsList() {
        return '/organisateurs/' . $this->getId() . '/competitions';
    }

    /**
     * Le nom de l'entreprise
     * @ORM\Column(type="string", length=255, nullable=false, unique=true)
     * @Groups({"read", "write", "brief"})
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

    /**
     * Le nom à afficher dans le profil
     * @Groups({"read", "brief"})
     * @return string
     */
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

