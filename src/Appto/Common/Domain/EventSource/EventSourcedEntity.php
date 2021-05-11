<?php

declare(strict_types=1);

namespace Appto\Common\Domain\EventSource;

use Appto\Common\Domain\DomainEvent;

interface EventSourcedEntity
{

    public function handleRecursively(DomainEvent $event): void;

    /**
     * Registers aggregateRoot as this EventSourcedEntity's aggregate root.
     *
     * @throws AggregateRootAlreadyRegisteredException
     */
    public function registerAggregateRoot(AggregateRoot $aggregateRoot): void;
}
