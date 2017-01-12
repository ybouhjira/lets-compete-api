<?php
namespace AppBundle\Action;

use AppBundle\Rest\SubResourcesList;
use Doctrine\ORM\EntityManager;

/**
 * Action: Récuperer toutes les solutions d'un participants
 */
class GetSubResourcesAction
{
    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @param integer $id The id of the parent resource
     * @param string $_parent_entity the parent entity
     *  (example: 'AppBundle:Book')
     *
     * @param string $_api_resource_class The full class
     *   name of the sub-resource
     *
     * @param string|null $_association the doctrine association that
     *   references the parent resource (example: 'author')
     *
     * @return SubResourcesList
     */
    public function __invoke(int $id,
                             string $_parent_entity,
                             string $_api_resource_class,
                             string $_association = null)
    {
        if (!$_association) {
            $_association = strtolower(
                preg_replace('/.*:/', '', $_parent_entity)
            );
        }

        $resShortClass = preg_replace('/.*\\\\/', '', $_api_resource_class);

        $parent = $this->entityManager
            ->getRepository($_parent_entity)
            ->find($id);

        return new SubResourcesList($resShortClass, $_association, $parent);
    }
}