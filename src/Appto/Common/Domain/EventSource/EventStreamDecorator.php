<?php

declare(strict_types=1);

namespace Appto\Common\Domain\EventSource;

use Appto\Common\Domain\DomainEventStream;

/**
 * Interface implemented by event stream decorators.
 *
 * An event stream decorator can alter the domain event stream before it is
 * written. An example would be adding metadata before writing the events to
 * storage.
 */
interface EventStreamDecorator
{
    public function decorateForWrite(
        string $aggregateType,
        string $aggregateIdentifier,
        DomainEventStream $eventStream
    ): DomainEventStream;
}
