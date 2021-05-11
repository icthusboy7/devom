<?php

declare(strict_types=1);

namespace Appto\Common\Domain\EventStore\Management;

use RuntimeException;

/**
 * Exceptions thrown by event store implementations.
 */
abstract class EventStoreManagementException extends RuntimeException
{
}
