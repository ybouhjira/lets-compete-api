<?php

namespace AppBundle\Service\Normalizer;

use Symfony\Bundle\FrameworkBundle\Routing\Router;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

/**
 * Custom normalizer
 */
class ResourceNormalizer implements NormalizerInterface
{
    /**
     * @var NormalizerInterface
     */
    private $baseNormalizer;

    /**
     * @var Router
     */
    private $router;

    public function __construct(NormalizerInterface $baseNormalizer,
                                Router $router)
    {
        $this->baseNormalizer = $baseNormalizer;
        $this->router = $router;
    }


    /**
     * Normalizes an object into a set of arrays/scalars.
     *
     * @param object $object object to normalize
     * @param string $format format the normalization result will be encoded as
     * @param array $context Context options for the normalizer
     *
     * @return array
     */
    public function normalize($object, $format = null, array $context = [])
    {
        $normalized = $this->baseNormalizer->normalize($object, $format, $context);

        $resourceName = strtolower(
            (new \ReflectionClass($object))->getShortName()
        );

        $routePrefix = "{$resourceName}_get_";
        $routes = $this->router->getRouteCollection()->getIterator();

        foreach ($routes as $name =>$route) {
            if (preg_match("/^$routePrefix/", $name)) {
                $matches = [];
                preg_match("/_get_(.*)/", $name, $matches);

                $subResRouteName = $routePrefix . $matches[1];
                $routePath = $this->router
                    ->getRouteCollection()
                    ->get($subResRouteName)
                    ->getPath();

                $url = preg_replace('/\\{id\\}/', $object->getId(), $routePath);

                $normalized[$matches[1]] = $url;
            }
        }

        return $normalized;
    }

    /**
     * Checks whether the given class is supported for normalization by this normalizer.
     *
     * @param mixed $data Data to normalize
     * @param string $format The format being (de-)serialized from or into
     *
     * @return bool
     */
    public function supportsNormalization($data, $format = null)
    {
        return $this->baseNormalizer->supportsNormalization($data, $format);
    }
}