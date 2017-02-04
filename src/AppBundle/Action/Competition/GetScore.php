<?php

namespace AppBundle\Action\Competition;

use AppBundle\Entity\Competition;

class GetScore
{
    public function __invoke(Competition $competition)
    {
        return $competition;
    }
}