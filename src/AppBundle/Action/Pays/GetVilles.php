<?php

namespace AppBundle\Action\Pays;

use AppBundle\Entity\Pays;
use AppBundle\Rest\SubResourcesList;

/**
 * Action: Récuperer toutes les villes d'un pays
 */
class GetVilles
{
    public function __invoke(Pays $p)
    {
        return new SubResourcesList('Ville', 'pays', $p);
    }
}