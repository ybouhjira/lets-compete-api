<?php
namespace AppBundle\Action\Organisateur;

use AppBundle\Entity\Organisateur;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\JsonResponse;

class GetCompetitions
{
    /**
     * @ParamConverter("post")
     * @param $organisateur
     * @return JsonResponse
     */
    public function __invoke(Organisateur $organisateur)
    {
        return $organisateur->getCompetitions()->toArray();
    }
}