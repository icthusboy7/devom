<?php

declare(strict_types=1);

namespace Appto\Common\Domain;

use Appto\Common\Domain\DateTime\DateTime;

final class DomainMessage
{
    private $playhead;
    private $metadata;
    private $payload;
    private $id;
    private $recordedOn;

    public function __construct(
        string $id,
        int $playhead,
        Metadata $metadata,
        DomainEvent $payload,
        DateTime $recordedOn
    ) {
        $this->id = (string)$id;
        $this->playhead = $playhead;
        $this->metadata = $metadata;
        $this->payload = $payload;
        $this->recordedOn = $recordedOn;
    }

    public function id(): string
    {
        return $this->id;
    }

    public function playhead(): int
    {
        return $this->playhead;
    }

    public function metadata(): Metadata
    {
        return $this->metadata;
    }

    public function payload(): DomainEvent
    {
        return $this->payload;
    }

    public function recordedOn(): DateTime
    {
        return $this->recordedOn;
    }

    public function type(): string
    {
        return strtr(get_class($this->payload), '\\', '.');
    }

    public static function recordNow(string $id, int $playhead, Metadata $metadata, DomainEvent $payload): self
    {
        return new self($id, $playhead, $metadata, $payload, DateTime::now());
    }

    /**
     * Creates a new DomainMessage with all things equal, except metadata.
     *
     * @param Metadata $metadata Metadata to add
     */
    public function andMetadata(Metadata $metadata): self
    {
        $newMetadata = $this->metadata->merge($metadata);

        return new self($this->id, $this->playhead, $newMetadata, $this->payload, $this->recordedOn);
    }
}
