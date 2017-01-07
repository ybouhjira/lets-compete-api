<?php
namespace AppBundle\Action\Participant;

use AppBundle\Entity\Participant;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Paginator;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Pagination\Paginator as DoctrineOrmPaginator;

class GetInvitParticipation
{
    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function __invoke(Participant $participant)
    {
        $query = $this->entityManager
            ->getRepository('AppBundle:InvitParticipation')
            ->createQueryBuilder('s')
            ->where('s.participant = :id')
            ->setParameter('id', $participant->getId())
            ->setMaxResults(10);

        return new Paginator(new DoctrineOrmPaginator($query));
    }
}