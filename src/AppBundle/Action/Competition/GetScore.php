<?php

namespace AppBundle\Action\Competition;

use AppBundle\Entity\Competition;
use AppBundle\Entity\Participant;
use AppBundle\Entity\Probleme;
use AppBundle\Entity\Solution;
use Doctrine\ORM\EntityManager;
use AppBundle\Entity\Participation;
use Doctrine\ORM\Query\Expr\Join;
use Symfony\Component\HttpFoundation\JsonResponse;

class GetScore
{
    /**
     * @var EntityManager
     */
    private $em;

    public function __construct(EntityManager $entityManager)
    {
        $this->em = $entityManager;
    }

    public function __invoke($id)
    {
        $result = $this->em
            ->createQueryBuilder()
            ->select('pp.id as participant, pp.nom, pp.prenom, AVG(s.tempsExecution) as average_exec_time')
            ->from(Competition::class, 'c')
            ->innerJoin('c.problemes', 'p')
            ->innerJoin('p.solutions', 's')
            ->innerJoin('s.participant', 'pp')
            ->groupBy('pp.id')
            ->orderBy('average_exec_time')
            ->getQuery()
            ->getResult();

        return new JsonResponse($result);
    }
}