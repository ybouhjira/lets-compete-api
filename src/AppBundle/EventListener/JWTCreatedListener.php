<?php
/**
 * Created by PhpStorm.
 * User: Wadii
 * Date: 10/01/2017
 * Time: 00:22
 */

namespace AppBundle\EventListener;


use AppBundle\Entity\Utilisateur;
use Doctrine\ORM\EntityManager;
use Lexik\Bundle\JWTAuthenticationBundle\Event\JWTCreatedEvent;

class JWTCreatedListener
{
    /**
     * @var EntityManager
     */
    private $entityManager;

    /**
     * @param EntityManager $entityManager
     */
    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @param JWTCreatedEvent $event
     *
     * @return void
     */
    public function onJWTCreated(JWTCreatedEvent $event)
    {
        $payload       = $event->getData();
        /** @var Utilisateur $user */
        $user = $this->entityManager
            ->getRepository('AppBundle:Utilisateur')
            ->findOneBy(['username' => $payload['username']]);

        $payload['role'] = strtolower(preg_replace('#.*\\\\#', '', get_class($user)));
        $payload['id'] = $user->getId();
        
        $event->setData($payload);
    }
}