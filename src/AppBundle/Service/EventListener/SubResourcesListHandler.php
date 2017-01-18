<?php

namespace AppBundle\Service\EventListener;

use ApiPlatform\Core\Bridge\Doctrine\Orm\Paginator;
use AppBundle\Rest\SubResourcesList;
use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpKernel\Event\GetResponseForControllerResultEvent;
use Doctrine\ORM\Tools\Pagination\Paginator as DoctrineOrmPaginator;

/**
 * Transforms a SubResourcesList to a Response
 */
class SubResourcesListHandler
{
    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function onKernelView(GetResponseForControllerResultEvent $event)
    {
        $result = $event->getControllerResult();

        if ($result instanceof SubResourcesList) {
            $query = $this->entityManager
                ->getRepository('AppBundle:' . $result->getSubResourceClass())
                ->createQueryBuilder('s')
                ->where("s.{$result->getAssociationName()} = :id")
                ->setParameter('id', $result->getParent()->getId())
                ->setMaxResults(10);

            $event->setControllerResult(
                new Paginator(new DoctrineOrmPaginator($query))
            );
        }
    }
}