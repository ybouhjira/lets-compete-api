<?php

namespace AppBundle\Action;

use Doctrine\Common\Persistence\ManagerRegistry;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\Routing\Annotation\Route;

class MembrePutPhoto
{
    /**
     * @Route(
     *     name="membre_put_photo",
     *     path="/membres/{id}/photo",
     *     defaults={
     *       "_api_resource_class"=Membre::class,
     *       "_api_item_operation_name"="put_photo"
     *     }
     * )
     * @Method("PUT")
     */
    public function __invoke($data)
    {
        return $data;
    }
}