<?php

declare(strict_types=1);

namespace Appto\Common\Domain\EventStore;

/**
 * Exception thrown if an event stream is not found.
 */
final class EventStreamNotFoundException extends EventStoreException
{
}
