<?php

declare(strict_types=1);

namespace Appto\Common\Domain\EventSource;

use Appto\Common\Domain\DomainEventStream;
use Appto\Common\Domain\EventHandling\EventBus;
use Appto\Common\Domain\EventSource\AggregateFactory\AggregateFactory;
use Appto\Common\Domain\EventStore\EventStore;
use Appto\Common\Domain\EventStore\EventStreamNotFoundException;
use Assert\Assertion as Assert;

/**
 * Naive initial implementation of an event sourced aggregate repository.
 */
abstract class EventSourcingRepository implements Repository
{
    private $eventStore;
    private $eventBus;
    private $aggregateClass;
    private $eventStreamDecorators;
    private $aggregateFactory;

    /**
     * @param EventStreamDecorator[] $eventStreamDecorators
     */
    public function __construct(
        EventStore $eventStore,
        EventBus $eventBus,
        string $aggregateClass,
        AggregateFactory $aggregateFactory,
        array $eventStreamDecorators = []
    ) {
        $this->assertExtendsEventSourcedAggregateRoot($aggregateClass);

        $this->eventStore = $eventStore;
        $this->eventBus = $eventBus;
        $this->aggregateClass = $aggregateClass;
        $this->aggregateFactory = $aggregateFactory;
        $this->eventStreamDecorators = $eventStreamDecorators;
    }

    public function load($id): AggregateRoot
    {
        try {
            $domainEventStream = $this->eventStore->load($id);

            return $this->aggregateFactory->create($this->aggregateClass, $domainEventStream);
        } catch (EventStreamNotFoundException $e) {
            throw new AggregateNotFoundException($id, $e);
        }
    }

    public function store(AggregateRoot $aggregate): void
    {
        // maybe we can get generics one day.... ;)
        Assert::isInstanceOf($aggregate, $this->aggregateClass);

        $domainEventStream = $aggregate->uncommittedEvents();
        $eventStream = $this->decorateForWrite($aggregate, $domainEventStream);
        $this->eventStore->append($aggregate->id(), $eventStream);
        $this->eventBus->publish($eventStream);
    }

    private function decorateForWrite(AggregateRoot $aggregate, DomainEventStream $eventStream): DomainEventStream
    {
        $aggregateType = get_class($aggregate);
        $aggregateIdentifier = $aggregate->id();

        foreach ($this->eventStreamDecorators as $eventStreamDecorator) {
            $eventStream = $eventStreamDecorator->decorateForWrite($aggregateType, $aggregateIdentifier, $eventStream);
        }

        return $eventStream;
    }

    private function assertExtendsEventSourcedAggregateRoot(string $class): void
    {
        Assert::subclassOf(
            $class,
            AggregateRoot::class,
            sprintf("Class '%s' is not an AggregateRoot.", $class)
        );
    }
}
