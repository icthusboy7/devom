<?php

declare(strict_types=1);

namespace Appto\Common\Domain\EventSource;

use Appto\Common\Domain\AggregateRoot as AggregateRootInterface;
use Appto\Common\Domain\DomainEvent;
use Appto\Common\Domain\DomainEventStream;
use Appto\Common\Domain\DomainMessage;
use Appto\Common\Domain\Metadata;

abstract class AggregateRoot implements AggregateRootInterface
{
    private $uncommittedEvents = [];
    private $playhead = -1; // 0-based playhead allows events[0] to contain playhead 0

    public function record(DomainEvent $event): void
    {
        $this->handleRecursively($event);

        ++$this->playhead;
        $this->uncommittedEvents[] = DomainMessage::recordNow(
            (string)$this->id(),
            $this->playhead,
            new Metadata([]),
            $event
        );
    }

    public function uncommittedEvents(): DomainEventStream
    {
        $stream = new DomainEventStream($this->uncommittedEvents);

        $this->uncommittedEvents = [];

        return $stream;
    }

    /**
     * Initializes the aggregate using the given "history" of events.
     */
    public function initializeState(DomainEventStream $stream): void
    {
        foreach ($stream as $message) {
            ++$this->playhead;
            $this->handleRecursively($message->getPayload());
        }
    }

    protected function handle(DomainEvent $event): void
    {
        $method = $this->applyMethod($event);

        if (!method_exists($this, $method)) {
            return;
        }

        $this->$method($event);
    }

    protected function handleRecursively(DomainEvent $event): void
    {
        $this->handle($event);

        foreach ($this->childEntities() as $entity) {
            $entity->registerAggregateRoot($this);
            $entity->handleRecursively($event);
        }
    }

    /**
     * Returns all child entities.
     * Override this method if your aggregate root contains child entities.
     *
     * @return EventSourcedEntity[]
     */
    protected function childEntities(): array
    {
        return [];
    }

    private function applyMethod(DomainEvent $event): string
    {
        $classParts = explode('\\', get_class($event));

        return 'apply' . end($classParts);
    }

    public function playhead(): int
    {
        return $this->playhead;
    }
}
