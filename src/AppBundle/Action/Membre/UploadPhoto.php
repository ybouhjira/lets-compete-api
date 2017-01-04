<?php
namespace AppBundle\Action\Membre;

use AppBundle\Entity\Membre;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\JsonResponse;

class UploadPhoto
{
    /**
     * @ParamConverter("post", class="Membre")
     * @param Membre $membre
     * @return Membre
     */
    public function __invoke(Membre $membre)
    {
        return new JsonResponse($membre);
    }
}