<?php
namespace AppBundle\Action\Organisateur;

use AppBundle\Entity\Organisateur;
use AppBundle\Rest\SubResourcesList;

/**
 * Action: Récuperer les compétitions d'un organisateur.
 */
class GetCompetitions
{
    public function __invoke(Organisateur $org)
    {
        return new SubResourcesList('Competition', 'organisateur', $org);
    }
}