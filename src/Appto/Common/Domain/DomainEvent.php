<?php

namespace Appto\Common\Domain;

use DateTimeInterface;

interface DomainEvent
{
    public function eventName(): string;
    public function eventVersion(): string;
    public function occurredOn(): DateTimeInterface;
}
