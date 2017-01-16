<?php

namespace AppBundle\Service\Filter;

use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\BooleanFilter
    as ApiPlatformBooleanFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Util\QueryNameGeneratorInterface;
use Doctrine\ORM\QueryBuilder;

/**
 * Boolean filter that supports null values
 */
class BooleanFilter extends ApiPlatformBooleanFilter
{
    /**
     * @inheritdoc
     */
    protected function filterProperty(
        string $property,
        $value,
        QueryBuilder $queryBuilder,
        QueryNameGeneratorInterface $queryNameGenerator,
        string $resourceClass,
        string $operationName = null
    ) {
        return parent::filterProperty(
            $property,
            $value,
            $queryBuilder,
            $queryNameGenerator,
            $resourceClass,
            $operationName
        );
    }
}