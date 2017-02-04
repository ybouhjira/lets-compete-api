<?php

namespace AppBundle\Action\Participant;

use AppBundle\Entity\Competition;
use AppBundle\Entity\Participant;
use AppBundle\Entity\Participation;
use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpFoundation\JsonResponse;

class AParticipe
{
    public function __construct(EntityManager $entityManager)
    {
        $this->em = $entityManager;
    }

    public function __invoke($pid, $cid)
    {

        $result = $this->em
            ->createQueryBuilder()
            ->select('1')
            ->from(Participation::class, 'p')
            ->where('p.participant = :pid')
            ->andWhere('p.competition = :cid')
            ->setParameters(compact('pid', 'cid'))
            ->getQuery()
            ->getResult();

        if (!count($result)) {
            $res = new JsonResponse(['error' => 'Ne participe pas']);
            $res->setStatusCode(404);
            return $res;
        }

        return new JsonResponse($result);
    }
}