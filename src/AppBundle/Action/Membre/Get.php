<?php
namespace AppBundle\Action\Membre;

use AppBundle\Entity\Membre;

/**
 * Opération GET simple sur un membre. Rédefinie parceque celle par défault
 * ne marche pas avec les classes hérité.
 * @package AppBundle\Action\Membre
 */
class Get
{
    public function __invoke(Membre $membre)
    {
        return $membre;
    }
}