<?php

namespace AppBundle\Service\Filter;

use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\FilterInterface;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Util\QueryNameGeneratorInterface;
use Doctrine\ORM\QueryBuilder;
use Symfony\Component\HttpFoundation\RequestStack;

/**
 * Filter on relations
 */
class RelatedIdsFilter implements FilterInterface
{
    private $request;
    private $field;

    public function __construct(RequestStack $requestStack, $field)
    {
        $this->field = $field;
        $this->request = $requestStack->getCurrentRequest();
    }

    /**
     * Applies the filter.
     *
     * @param QueryBuilder $queryBuilder
     * @param QueryNameGeneratorInterface $queryNameGenerator
     * @param string $resourceClass
     * @param string|null $operationName
     */
    public function apply(
        QueryBuilder $queryBuilder,
        QueryNameGeneratorInterface $queryNameGenerator,
        string $resourceClass,
        string $operationName = null
    ) {
        $param = $this->request->get($this->field);
        if (!$param) return;

        $ids = explode(',', $param);

        $alias = 'rel';
        $param = $queryNameGenerator->generateParameterName('id');

        $queryBuilder
            ->join("o.$this->field", $alias)
            ->andWhere("$alias.id IN (:$param)")
            ->setParameter($param, $ids);
    }

    /**
     * Gets the description of this filter for the given resource.
     *
     * Returns an array with the filter parameter names as keys and array with the following data as values:
     *   - property: the property where the filter is applied
     *   - type: the type of the filter
     *   - required: if this filter is required
     *   - strategy: the used strategy
     *   - swagger (optional): additional parameters for the path operation, e.g. 'swagger' => ['description' => 'My Description']
     * The description can contain additional data specific to a filter.
     *
     * @param string $resourceClass
     *
     * @return array
     */
    public function getDescription(string $resourceClass): array
    {
        return [
            $this->field => [
                'property' => $this->field,
                'required' => false,
                'type' => 'array'
            ]
        ];
    }
}