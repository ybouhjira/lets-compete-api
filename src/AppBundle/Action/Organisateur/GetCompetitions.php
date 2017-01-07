<?php
namespace AppBundle\Action\Organisateur;

use ApiPlatform\Core\Bridge\Doctrine\Orm\Paginator;
use AppBundle\Entity\Competition;
use AppBundle\Entity\Organisateur;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Pagination\Paginator as DoctrineOrmPaginator;
use Symfony\Component\HttpFoundation\JsonResponse;

class GetCompetitions
{
    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @param $organisateur
     * @return JsonResponse
     */
    public function __invoke(Organisateur $organisateur)
    {
        $query = $this->entityManager
            ->getRepository('AppBundle:Competition')
            ->createQueryBuilder('s')
            ->where('s.organisateur = :id')
            ->setParameter('id', $organisateur->getId())
            ->setMaxResults(10);

        return new Paginator(new DoctrineOrmPaginator($query));
    }
}