<?php

declare(strict_types=1);

namespace Appto\Common\Domain\EventDispatcher;

/**
 * Event dispatcher implementation.
 */
final class CallableEventDispatcher implements EventDispatcher
{
    private $listeners = [];

    /**
     * {@inheritdoc}
     */
    public function dispatch(string $eventName, array $arguments): void
    {
        if (!isset($this->listeners[$eventName])) {
            return;
        }

        foreach ($this->listeners[$eventName] as $listener) {
            call_user_func_array($listener, $arguments);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function addListener(string $eventName, callable $callable): void
    {
        if (!isset($this->listeners[$eventName])) {
            $this->listeners[$eventName] = [];
        }

        $this->listeners[$eventName][] = $callable;
    }
}
