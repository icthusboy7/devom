<?php

declare(strict_types=1);

namespace Appto\Common\Domain\EventStore\Management;

/**
 * Criteria not supported by implementation.
 *
 * In some cases an event store implementation may implement management
 * but not be able to satisfy all criteria options. In this case, the
 * implementation must throw this exception.
 *
 * Class CriteriaNotSupportedException
 */
final class CriteriaNotSupportedException extends EventStoreManagementException
{
}
