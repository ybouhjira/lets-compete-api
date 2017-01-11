<?php
namespace AppBundle\Action\Participant;

use AppBundle\Entity\Participant;
use AppBundle\Rest\SubResourcesList;

/**
 * Action: Récuperer les invitations de participation d'un participant
 */
class GetInvitParticipation
{
    public function __invoke(Participant $p)
    {
        return new SubResourcesList('InvitParticipation', 'participant', $p);
    }
}