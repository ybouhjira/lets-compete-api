<?php

namespace AppBundle\Action\Participant;

use Doctrine\ORM\EntityManager;
use Proxies\__CG__\AppBundle\Entity\Competition;
use Proxies\__CG__\AppBundle\Entity\Participant;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

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
            ->from(Participant::class, 'p')
            ->innerJoin(Competition::class, 'c')
            ->where('c.id = :cid')
            ->andWhere('p.id = :pid')
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