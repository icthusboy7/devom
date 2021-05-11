<?php

declare(strict_types=1);

namespace Appto\Common\Domain\EventStore;

use Appto\Common\Domain\DomainEventStream;
use Exception;

final class DuplicatePlayheadException extends EventStoreException
{
    private $eventStream;

    public function __construct(DomainEventStream $eventStream, Exception $previous = null)
    {
        parent::__construct('', 0, $previous);

        $this->eventStream = $eventStream;
    }

    public function eventStream(): DomainEventStream
    {
        return $this->eventStream;
    }
}
