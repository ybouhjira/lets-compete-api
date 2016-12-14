<?php

namespace AppBundle\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Organiser
 * @ORM\Entity(repositoryClass="AppBundle\Repository\OrganiserRepository")
 * @ApiResource(attributes={
 *     "normalization_context"={"groups"={"read"}},
 *     "denormalization_context"={"groups"={"write"}}
 * })
 */
class Organiser extends User
{
    /**
     * @ORM\OneToMany(
     *     targetEntity="Competition",
     *     mappedBy="organiser",
     *     cascade={"persist"}
     * )
     * @var
     */
    private $competitions;

    public function __construct()
    {
        parent::__construct();
        $this->competitions = new ArrayCollection();
        $this->addRole('ROLE_ORGANISER');
    }

    public function addCompetition(Competition $competition)
    {
        $this->competitions->add($competition);
        $competition->setOrganiser($this);
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
}

