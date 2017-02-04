<?php

namespace AppBundle\Action\Competition;

use AppBundle\Entity\Competition;
use AppBundle\Entity\Participant;
use AppBundle\Entity\Probleme;
use AppBundle\Entity\Solution;
use Doctrine\ORM\EntityManager;
use AppBundle\Entity\Participation;
use Doctrine\ORM\Query\Expr\Join;

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

    public function __invoke(Competition $competition)
    {
        $id = $competition->getId();

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

        return $result;

//        /** @var \DateInterval $dureeEnSeconds */
//        $dureeEnSeconds = $competition->getTempsFin()->getTimestamp() -
//            $competition->getTempsDebut()->getTimestamp();
//
//        $participants = [];
//        foreach($competition->getParticipations() as $participation) {
//            $participants[$participation->getParticipant()->getId()] =
//                $dureeEnSeconds;
//        }
//
//        dump($participants);
//        /** @var Probleme $probleme */
//        /** @var Solution $solution*/
//        foreach ($competition->getProblemes() as $probleme) {
//            foreach ($probleme->getSolutions() as $solution) {
//                dump([
//                    'envoie' => $solution->getTempsEnvoie(),
//                    'exec' => $solution->getTempsExecution(),
//                    'user' => $solution->getParticipant()->getNomAffiche()
//                ]);
//            }
//        }
    }
}