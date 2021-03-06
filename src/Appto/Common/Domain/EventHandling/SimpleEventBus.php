<?php

declare(strict_types=1);

namespace Appto\Common\Domain\EventHandling;

use Appto\Common\Domain\DomainEventStream;

/**
 * Simple synchronous publishing of events.
 */
final class SimpleEventBus implements EventBus
{
    private $eventListeners = [];
    private $queue = [];
    private $isPublishing = false;

    /**
     * {@inheritdoc}
     */
    public function subscribe(EventListener $eventListener): void
    {
        $this->eventListeners[] = $eventListener;
    }

    /**
     * {@inheritdoc}
     */
    public function publish(DomainEventStream $domainMessages): void
    {
        foreach ($domainMessages as $domainMessage) {
            $this->queue[] = $domainMessage;
        }

        if (!$this->isPublishing) {
            $this->isPublishing = true;

            try {
                while ($domainMessage = array_shift($this->queue)) {
                    foreach ($this->eventListeners as $eventListener) {
                        $eventListener->handle($domainMessage);
                    }
                }
            } finally {
                $this->isPublishing = false;
            }
        }
    }
}
