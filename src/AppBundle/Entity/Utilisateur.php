<?php

namespace AppBundle\Entity;

use ApiPlatform\Core\Annotation\ApiResource;

use FOS\UserBundle\Model\User as BaseUser;
use FOS\UserBundle\Model\UserInterface;
use JMS\Serializer\Annotation\ExclusionPolicy;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 *
 *
 */
abstract class Utilisateur extends BaseUser
{
    /**
     *
     *
     */
    protected $id;

    /**
     * @Groups({"read", "write", "invit-read"})
     */
    protected $email;

    /**
     * @Groups({"write"})
     */
    protected $plainPassword;

    /**
     * @Groups({"read", "write"})
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