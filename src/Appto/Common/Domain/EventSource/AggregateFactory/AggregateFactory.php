<?php

declare(strict_types=1);

namespace Appto\Common\Domain\EventSource\AggregateFactory;

use Appto\Common\Domain\DomainEventStream;
use Appto\Common\Domain\EventSource\AggregateRoot;

interface AggregateFactory
{
    /**
     * @param string $aggregateClass the FQCN of the Aggregate to create
     */
    public function create(string $aggregateClass, DomainEventStream $domainEventStream): AggregateRoot;
}
