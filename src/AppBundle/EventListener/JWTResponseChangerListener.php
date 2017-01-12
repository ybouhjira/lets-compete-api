<?php

namespace AppBundle\EventListener;

use AppBundle\Entity\Utilisateur;
use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Routing\Router;
use Symfony\Component\HttpKernel\Event\FilterResponseEvent;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\HttpKernel\Event\GetResponseForControllerResultEvent;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Serializer\Serializer;

/**
 * Ajoute l'id de l'utilisateur au token JWT
 */
class JWTResponseChangerListener
{

    public function __construct(EntityManager $entityManager,
                                Serializer $serializer)
    {
        $this->em = $entityManager;
        $this->serializer = $serializer;
    }

    public function onKernelResponse(FilterResponseEvent $event)
    {
        if (!$this->routeIsLoginRoute($event) || !$this->hasToken($event))
            return;

        $username = $event->getRequest()->get('_username');
        /** @var Utilisateur $user */
        $user = $this->em
            ->getRepository('AppBundle:Utilisateur')
            ->findBy(['username' => $username])[0];

        $content = json_decode($event->getResponse()->getContent());
        $content->utilisateur = [
            '@id' => '/utilisateurs/' . $user->getId(),
            '@type' => preg_replace('#.*\\\\#', '', get_class($user))
        ];

        $event->getResponse()->setContent(
            $this->serializer->encode($content, 'json')
        );
    }

    private function routeIsLoginRoute(FilterResponseEvent $event)
    {
        return $event->getRequest()->get('_route') === 'api_login_check';
    }

    private function hasToken(FilterResponseEvent $event)
    {
        return !empty(json_decode($event->getResponse()->getContent())->token);
    }
}