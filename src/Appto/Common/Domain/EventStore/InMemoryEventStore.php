<?php

declare(strict_types=1);

namespace Appto\Common\Domain\EventStore;

use Appto\Common\Domain\DomainEventStream;
use Appto\Common\Domain\DomainMessage;
use Appto\Common\Domain\EventStore\Management\Criteria;
use Appto\Common\Domain\EventStore\Management\EventStoreManagement;

/**
 * In-memory implementation of an event store.
 *
 * Useful for testing code that uses an event store.
 */
final class InMemoryEventStore implements EventStore, EventStoreManagement
{
    private $events = [];

    /**
     * {@inheritdoc}
     */
    public function load($id): DomainEventStream
    {
        $id = (string) $id;

        if (isset($this->events[$id])) {
            return new DomainEventStream($this->events[$id]);
        }

        throw new EventStreamNotFoundException(sprintf('EventStream not found for aggregate with id %s', $id));
    }

    /**
     * {@inheritdoc}
     */
    public function loadFromPlayhead($id, int $playhead): DomainEventStream
    {
        $id = (string) $id;

        if (!isset($this->events[$id])) {
            return new DomainEventStream([]);
        }

        return new DomainEventStream(
            array_values(
                array_filter(
                    $this->events[$id],
                    function ($event) use ($playhead) {
                        return $playhead <= $event->getPlayhead();
                    }
                )
            )
        );
    }

    /**
     * {@inheritdoc}
     */
    public function append($id, DomainEventStream $eventStream): void
    {
        $id = (string) $id;

        if (!isset($this->events[$id])) {
            $this->events[$id] = [];
        }

        $this->assertStream($this->events[$id], $eventStream);

        /** @var DomainMessage $event */
        foreach ($eventStream as $event) {
            $playhead = $event->playhead();

            $this->events[$id][$playhead] = $event;
        }
    }

    /**
     * @param DomainMessage[] $events
     */
    private function assertStream(array $events, DomainEventStream $eventsToAppend): void
    {
        /** @var DomainMessage $event */
        foreach ($eventsToAppend as $event) {
            $playhead = $event->playhead();

            if (isset($events[$playhead])) {
                throw new DuplicatePlayheadException($eventsToAppend);
            }
        }
    }

    public function visitEvents(Criteria $criteria, EventVisitor $eventVisitor): void
    {
        foreach ($this->events as $id => $events) {
            foreach ($events as $event) {
                if (!$criteria->isMatchedBy($event)) {
                    continue;
                }

                $eventVisitor->doWithEvent($event);
            }
        }
    }
}
