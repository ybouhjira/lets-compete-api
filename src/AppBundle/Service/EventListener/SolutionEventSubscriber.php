<?php

namespace AppBundle\Service\EventListener;

use AppBundle\Entity\Solution;
use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Event\LifecycleEventArgs;
use OldSound\RabbitMqBundle\RabbitMq\ProducerInterface;
use Symfony\Component\HttpKernel\Kernel;
use Symfony\Component\Serializer\Serializer;

/**
 * Event listener for Solutions
 */
class SolutionEventSubscriber implements EventSubscriber
{
    /**
     * @var ProducerInterface
     */
    private $producer;

    /**
     * @var Serializer
     */
    private $container;

    /**
     * SolutionEventListener constructor.
     * @param ProducerInterface $producer
     * @param Kernel $kernel
     * @internal param Serializer $serializer
     */
    public function __construct(ProducerInterface $producer,
                                Kernel $kernel)
    {
        $this->producer = $producer;
        $this->container = $kernel->getContainer();
    }

    public function prePersist(LifecycleEventArgs $args)
    {
        /** @var Solution $entity */
        $entity = $args->getEntity();

        if (php_sapi_name() === 'cli' || ! ($entity instanceof Solution))
            return;

        $serializer = $this->container->get('serializer');
        $json = $serializer->serialize([
            'solution' => $entity,
            'entreeSorties' => $entity->getProbleme()->getEntreeSorties()
        ], 'json');
        $this->producer->publish($json);
    }

    /**
     * @inheritdoc
     */
    public function getSubscribedEvents()
    {
        return ['prePersist'];
    }
}
