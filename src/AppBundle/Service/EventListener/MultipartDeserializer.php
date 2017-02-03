<?php

namespace AppBundle\Service\EventListener;

use ApiPlatform\Core\Exception\RuntimeException;
use ApiPlatform\Core\Util\RequestAttributesExtractor;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use ApiPlatform\Core\EventListener\DeserializeListener as DecoratedListener;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use ApiPlatform\Core\Serializer\SerializerContextBuilderInterface;

final class MultipartDeserializer
{
    private $decorated;
    private $denormalizer;
    private $serializerContextBuilder;

    public function __construct(DenormalizerInterface $denormalizer,
                                SerializerContextBuilderInterface $serializerContextBuilder,
                                DecoratedListener $decorated)
    {
        $this->denormalizer = $denormalizer;
        $this->serializerContextBuilder = $serializerContextBuilder;
        $this->decorated = $decorated;
    }

    public function onKernelRequest(GetResponseEvent $event) {

        $req = $event->getRequest();

        if ($req->isMethodSafe() || $req->isMethod(Request::METHOD_DELETE)) {
            return;
        }

        $contentType = 'multipart/form-data';

        if (preg_match("#^$contentType#", $req->headers->get('content-type')))
            $this->denormalizeFormRequest($req);
        else
            $this->decorated->onKernelRequest($event);
    }

    private function denormalizeFormRequest(Request $request)
    {
        try {
            $attributes = RequestAttributesExtractor::extractAttributes($request);
        } catch (RuntimeException $e) {
            return;
        }

        $context = $this->serializerContextBuilder
            ->createFromRequest($request, false, $attributes);

        $data = $request->request
            ->all();

        $object = $this->denormalizer
            ->denormalize(
                $data, $attributes['resource_class'], null, $context
            );

        $request->attributes
            ->set('data', $object);
    }
}