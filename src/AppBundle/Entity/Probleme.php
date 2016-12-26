<?php

namespace AppBundle\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * Un problème un compétition
 *
 * @ORM\Table(name="probleme")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ProblemeRepository")
 * @ApiResource(attributes={
 *     "normalization_context"={"groups"={"read"}},
 *     "denormalization_context"={"groups"={"write"}}
 * })
 */
class Probleme
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
     * @ORM\Column(name="enonce", type="text")
     */
    private $enonce;

    /**
     * @ORM\ManyToOne(targetEntity="Competition", inversedBy="problemes")
     * @ORM\JoinColumn(name="compeititon_id", referencedColumnName="id")
     */
    private $competition;

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
     * @return mixed
     */
    public function getCompetition()
    {
        return $this->competition;
    }

    /**
     * @param mixed $competition
     * @return Probleme
     */
    public function setCompetition($competition)
    {
        $this->competition = $competition;
        return $this;
    }

    /**
     * Set enonce
     *
     * @param string $enonce
     *
     * @return Probleme
     */
    public function setEnonce($enonce)
    {
        $this->enonce = $enonce;

        return $this;
    }

    /**
     * Get enonce
     *
     * @return string
     */
    public function getEnonce()
    {
        return $this->enonce;
    }
}

