<?php

declare(strict_types=1);

namespace Appto\Common\Domain\EventSource\MetadataEnrichment;

use Appto\Common\Domain\DomainEventStream;
use Appto\Common\Domain\EventSource\EventStreamDecorator;
use Appto\Common\Domain\Metadata;

/**
 * Event stream decorator that adds extra metadata.
 */
final class MetadataEnrichingEventStreamDecorator implements EventStreamDecorator
{
    private $metadataEnrichers;

    /**
     * @param MetadataEnricher[] $metadataEnrichers
     */
    public function __construct(array $metadataEnrichers = [])
    {
        $this->metadataEnrichers = $metadataEnrichers;
    }

    public function registerEnricher(MetadataEnricher $enricher): void
    {
        $this->metadataEnrichers[] = $enricher;
    }

    /**
     * {@inheritdoc}
     */
    public function decorateForWrite(
        string $aggregateType,
        string $aggregateIdentifier,
        DomainEventStream $eventStream
    ): DomainEventStream {
        if (empty($this->metadataEnrichers)) {
            return $eventStream;
        }

        $messages = [];

        foreach ($eventStream as $message) {
            $metadata = new Metadata();

            foreach ($this->metadataEnrichers as $metadataEnricher) {
                $metadata = $metadataEnricher->enrich($metadata);
            }

            $messages[] = $message->andMetadata($metadata);
        }

        return new DomainEventStream($messages);
    }
}
