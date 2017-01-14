<?php
namespace AppBundle\Action;

use ApiPlatform\Core\Bridge\Doctrine\Orm\Paginator;

class CollectionAction
{
    public function __invoke($data, $id)
    {
//        dump($data);
//        die();
        return $data;
    }
}