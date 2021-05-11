<?php

declare(strict_types=1);

namespace Appto\Common\Domain;

class DomainEventStream implements \IteratorAggregate
{
    private $events;

    /**
     * @param DomainMessage[]  $events
     */
    public function __construct(array $events)
    {
        $this->events = $events;
    }

    public function getIterator(): \ArrayIterator
    {
        return new \ArrayIterator($this->events);
    }

    /**
     * @return DomainEvent[]
     */
    public function events(): array
    {
        return array_map(function (DomainMessage $message) {
            return $message->payload();
        }, $this->events);
    }

    public function length(): int
    {
        return \count($this->events);
    }
}
