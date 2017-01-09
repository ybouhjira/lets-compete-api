<?php

namespace AppBundle\Action\Ville;

use AppBundle\Entity\Pays;
use Doctrine\ORM\EntityManager;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Paginator;
use Doctrine\ORM\Tools\Pagination\Paginator as DoctrineOrmPaginator;

/**
 * Created by PhpStorm.
 * User: Wadii
 * Date: 08/01/2017
 * Time: 21:25
 */
class GetVilles
{
    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function __invoke(Pays $pays)
    {
        $query = $this->entityManager
            ->getRepository('AppBundle:Villes')
            ->createQueryBuilder('s')
            ->where('s.pays = :id')
            ->setParameter('id', $pays->getId())
            ->setMaxResults(10);

        return new Paginator(new DoctrineOrmPaginator($query));
    }
}