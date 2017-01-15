<?php
namespace AppBundle\Service\Extension;

use ApiPlatform\Core\Bridge\Doctrine\Orm\Extension\QueryCollectionExtensionInterface;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Util\QueryNameGeneratorInterface;
use Doctrine\ORM\QueryBuilder;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;

class ParentExtension implements QueryCollectionExtensionInterface
{

    private $request;

    public function __construct(RequestStack $requestStack)
    {
        $this->request = $requestStack->getCurrentRequest();
    }

    /**
     * @param QueryBuilder $queryBuilder
     * @param QueryNameGeneratorInterface $queryNameGenerator
     * @param string $resourceClass
     * @param string|null $operationName
     */
    public function applyToCollection(
        QueryBuilder $queryBuilder,
        QueryNameGeneratorInterface $queryNameGenerator,
        string $resourceClass,
        string $operationName = null
    )
    {
        $attrs = $this->request->attributes;

        if (!$attrs->has('_sub_resource'))
            return;

        $id = $attrs->get('_route_params')['id'];
        $parent = $attrs->get('_parent_entity');

        if (!$attrs->has('_parent_entity')) {
            $queryBuilder
                ->join('o.' . $attrs->get('_related_entity'), 'rel')
                ->where('rel.id = :id')
                ->setParameter('id', $id);
        } else {
            $queryBuilder
                ->where("o.$parent = :id")
                ->setParameter('id', $id);
        }
    }
}