<?php

namespace AppBundle\Service\EventListener;

use Doctrine\Common\EventSubscriber;
use OldSound\RabbitMqBundle\RabbitMq\ProducerInterface;

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
     * SolutionEventListener constructor.
     * @param ProducerInterface $producer
     */
    public function __construct(ProducerInterface $producer)
    {
        $this->producer = $producer;
    }

    public function prePersist()
    {
        $this->producer->publish('Hello', 'key');
    }

    /**
     * @inheritdoc
     */
    public function getSubscribedEvents()
    {
        return ['prePersist'];
    }
}