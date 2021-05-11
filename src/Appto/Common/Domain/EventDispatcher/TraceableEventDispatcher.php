<?php

declare(strict_types=1);

namespace Appto\Common\Domain\EventDispatcher;

final class TraceableEventDispatcher implements EventDispatcher
{
    private $dispatchedEvents = [];

    public function dispatch(string $eventName, array $arguments): void
    {
        $this->dispatchedEvents[] = ['event' => $eventName, 'arguments' => $arguments];
    }

    public function addListener(string $eventName, callable $callable): void
    {
        return;
    }

    public function dispatchedEvents(): array
    {
        return $this->dispatchedEvents;
    }
}
