<?php

declare(strict_types=1);

namespace Appto\Common\Domain\EventStore;

use RuntimeException;

/**
 * Exceptions thrown by event store implementations.
 */
abstract class EventStoreException extends RuntimeException
{
}
