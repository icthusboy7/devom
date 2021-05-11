<?php

declare(strict_types=1);

namespace Appto\Common\Domain\EventStore;

use Appto\Common\Domain\DomainEventStream;

/**
 * Loads and stores events.
 */
interface EventStore
{
    /**
     * @param mixed $id
     */
    public function load($id): DomainEventStream;

    /**
     * @param mixed $id
     */
    public function loadFromPlayhead($id, int $playhead): DomainEventStream;

    /**
     * @param mixed $id
     *
     * @throws DuplicatePlayheadException
     */
    public function append($id, DomainEventStream $eventStream): void;
}
