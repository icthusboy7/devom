<?php

declare(strict_types=1);

namespace Appto\Common\Domain;

use Appto\Common\Domain\Identity\Uuid;

interface AggregateRoot
{
    public function id();

    public function record(DomainEvent $event): void;

    public function uncommittedEvents(): DomainEventStream;
}
