<?php

declare(strict_types=1);

namespace Appto\Common\Domain\EventHandling;

use Appto\Common\Domain\DomainEventStream;
use Appto\Common\Domain\DomainMessage;

/**
 * Event bus that is able to record all dispatched events.
 */
final class TraceableEventBus implements EventBus
{
    private $eventBus;
    private $recorded = [];
    private $tracing = false;

    public function __construct(EventBus $eventBus)
    {
        $this->eventBus = $eventBus;
    }

    public function subscribe(EventListener $eventListener): void
    {
        $this->eventBus->subscribe($eventListener);
    }

    public function publish(DomainEventStream $domainMessages): void
    {
        $this->eventBus->publish($domainMessages);

        if (!$this->tracing) {
            return;
        }

        foreach ($domainMessages as $domainMessage) {
            $this->recorded[] = $domainMessage;
        }
    }

    public function events(): array
    {
        return array_map(
            function (DomainMessage $message) {
                return $message->payload();
            },
            $this->recorded
        );
    }

    /**
     * Start tracing.
     */
    public function trace(): void
    {
        $this->tracing = true;
    }
}
