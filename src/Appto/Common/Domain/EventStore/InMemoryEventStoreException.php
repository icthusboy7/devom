<?php

declare(strict_types=1);

namespace Appto\Common\Domain\EventStore;

/**
 * Wraps exceptions thrown by the in-memory event store.
 */
class InMemoryEventStoreException extends EventStoreException
{
}
