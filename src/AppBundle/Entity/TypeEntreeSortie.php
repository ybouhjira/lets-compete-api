<?php

namespace AppBundle\Entity;

use ApiPlatform\Core\Annotation\ApiResource;

use Symfony\Component\Serializer\Annotation\Groups;

/**
 * TypeEntreeSortie
 *
 *
 *
 * @ApiResource()
 */
class TypeEntreeSortie
{
    /**
     * @var int
     *
     *
     *
     * @Groups({"entreeSortie"})
     */
    private $id;

    /**
     * @var string
     *
     *
     * @Groups({"entreeSortie"})
     */
    private $name;

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
     * Set name
     *
     * @param string $name
     *
     * @return TypeEntreeSortie
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }
}

