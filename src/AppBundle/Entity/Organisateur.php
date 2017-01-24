<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;

/**
 * Organisateur
 */
class Organisateur extends Membre
{
    /**
     * @var ArrayCollection
     */
    protected $competitions;

    /**
     * Le nom de l'entreprise
     * @var string
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
     *
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

