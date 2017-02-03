<?php

namespace AppBundle\Entity;

use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * Membre
 */
abstract class Membre extends Utilisateur
{
    /**
     * @var string
     *
     *
     */
    private $presentation;

    /**
     * @var File La photo de profil
     */
    private $fichierPhoto;

    /**
     * @var \DateTime
     */
    private $updatedAt;

    /**
     * @var string
     */
    private $cheminPhoto;

    /**
     * @var string
     */
    private $telephone;

    /**
     * @var string
     */
    private $adresse;

    /**
     * @var Ville La ville de résidance
     */
    private $ville;

    /**
     * @var string L'adresse de son site web
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
     * If manually uploading a file (i.e. not using Symfony Form) ensure an
     * instance of 'UploadedFile' is injected into this setter to trigger
     * the  update. If this bundle's configuration parameter
     * 'inject_on_load' is set to 'true' this setter  must be able
     * to accept an instance of 'File' as the bundle will inject one here
     * during Doctrine hydration.
     *
     * @param File $fichierPhoto
     *
     * @return Membre $this
     */
    public function setFichierPhoto(File $fichierPhoto = null)
    {
        $this->fichierPhoto = $fichierPhoto;

        if ($fichierPhoto) {
            // It is required that at least one field changes if you
            // are using doctrine otherwise the event listeners won't
            // be called and the file is lost
            $this->updatedAt = new \DateTimeImmutable();
        }

        return $this;
    }

    /**
     * Getter
     * @return File|null
     */
    public function getFichierPhoto()
    {
        return $this->fichierPhoto;
    }

    /**
     * Le chemin de la photo du profil.
     * @return string
     */
    public function getCheminPhoto()
    {
        return $this->cheminPhoto;
    }

    /**
     * @param string $cheminPhoto
     * @return Membre
     */
    public function setCheminPhoto($cheminPhoto)
    {
        $this->cheminPhoto = $cheminPhoto;
        return $this;
    }
    
    /**
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * @param \DateTime $updatedAt
     * @return Membre
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }

    /**
     * Setter
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
     * L'adresse
     * @return string
     */
    public function getAdresse()
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

