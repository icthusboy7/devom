<?php

declare(strict_types=1);

namespace Appto\Devotional\Domain\Devotional;

use Appto\Common\Domain\DomainEvent;
use DateTime;
use DateTimeInterface;

abstract class DevotionalEvent implements DomainEvent
{
    /** @var DateTimeInterface */
    private $occurredOn;
    private $eventVersion;

    abstract public function eventName(): string;

    public function __construct()
    {
        $this->occurredOn = new DateTime('now');
        $this->eventVersion = '1';
    }

    public function eventVersion(): string
    {
        return $this->eventVersion;
    }

    public function occurredOn(): DateTimeInterface
    {
        return $this->occurredOn;
    }
}
