<?php

namespace AppBundle\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User as BaseUser;
use FOS\UserBundle\Model\UserInterface;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="_type", type="string")
 *
 * ORM\DiscriminatorMap({
 *     "admin" = "Admin",
 *     "organisateur" = "Organisateur",
 *     "participant" = "Participant"
 * })
 *
 * @ORM\Table(name="utilisateur")
 *
 * @ApiResource(attributes={
 *     "normalization_context"={"groups"={"user", "user-read"}},
 *     "denormalization_context"={"groups"={"user", "user-write"}}
 * })
 */
abstract class Utilisateur extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @Groups({"user"})
     */
    protected $email;

    /**
     * @Groups({"user-write"})
     */
    protected $plainPassword;

    /**
     * @Groups({"user"})
     */
    protected $username;

    /**
     * User constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->addRole('ROLE_USER');
    }

    public function isUser(UserInterface $user = null)
    {
        return $user instanceof self && $user->id === $this->id;
    }
}