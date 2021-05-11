<?php

declare(strict_types=1);

namespace Appto\Common\Domain\EventDispatcher;

/**
 * Base type for an event dispatcher.
 */
interface EventDispatcher
{
    public function dispatch(string $eventName, array $arguments): void;

    public function addListener(string $eventName, callable $callable): void;
}
