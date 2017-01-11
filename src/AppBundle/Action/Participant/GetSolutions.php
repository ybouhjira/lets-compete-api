<?php
namespace AppBundle\Action\Participant;

use AppBundle\Entity\Participant;
use AppBundle\Rest\SubResourcesList;

/**
 * Action: Récuperer toutes les solutions d'un participants
 */
class GetSolutions
{
    public function __invoke(Participant $p)
    {
        return new SubResourcesList('InvitParticipation', 'participant', $p);
    }
}