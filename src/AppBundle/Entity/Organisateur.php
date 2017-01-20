<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;

use Symfony\Component\Serializer\Annotation\Groups;

/**
 * Organisateur
 *
 */
class Organisateur extends Membre
{
    /**
     *
     */
    protected $competitions;

    /**
     * Le nom de l'entreprise
     *
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

