<?php

declare(strict_types=1);

namespace Appto\Devotional\Domain\Devotional;

use Appto\Common\Domain\EventSource\AggregateRoot;
use Appto\Common\Domain\Nullable;
use Appto\Common\Domain\Url\Url;

class Devotional extends AggregateRoot
{
    private $id;
    private $title;
    private $passage;
    private $content;
    private $bibleReading;
    private $audioUrl;
    private $authorId;
    private $publisherId;
    private $topics;
    private $status;

    /**
     * @var TopicId[] $topics
     */
    public function __construct(
        DevotionalId $id,
        Title $title,
        Content $content,
        ?string $bibleReading,
        ?Url $audioUrl,
        AuthorId $authorId,
        PublisherId $publisherId,
        Passage $passage,
        ?array $topics
    ) {
        $this->record(new DevotionalCreated(
            $id,
            $title,
            $content,
            $bibleReading,
            $audioUrl,
            $authorId,
            $publisherId,
            $passage,
            $topics,
            DevotionalStatus::created()
        ));
    }

    protected function applyDevotionalCreated(DevotionalCreated $event): void
    {
        $this->id = $event->id();
        $this->title = $event->title();
        $this->authorId = $event->authorId();
        $this->publisherId = $event->publisherId();
        $this->content = $event->content();
        $this->bibleReading = $event->bibleReading();
        $this->audioUrl = $event->audioUrl();
        $this->passage = $event->passage();
        $this->status = $event->status();

        $this->topics = [];
        array_map(function (TopicId $topicId) {
                $this->addTopic($topicId);
        },
            $event->topics());
    }

    public function addTopic(TopicId $topicId): void
    {
        if (in_array($topicId, $this->topics)) {
            return;
        }
        array_push($this->topics, $topicId);

        //WIP: record TopicAdded
    }

    public function removeTopic(TopicId $topicId): void
    {
        unset($this->topics[$topicId->value()]);
    }

    public function publish(): void
    {
        if (!$this->status->isApproved()) {
            return;
        }
        $this->status = DevotionalStatus::published();

        //WIP record DevotionalPublished
    }

    public function isPublished(): bool
    {
        return $this->status->isPublished();
    }

    public function doctrinePrePersist(): void
    {
        $this->topics = array_map(
            function (TopicId $topicId) {
                return $topicId->value();
            },
            $this->topics
        );
    }

    public function doctrinePostLoad(): void
    {
        $this->topics = array_map(
            function (string $topicId) {
                return new TopicId($topicId);
            },
            $this->topics
        );

        if ($this->audioUrl instanceof Nullable && $this->audioUrl->isNull()) {
            $this->audioUrl = null;
        }
    }

    public function id(): DevotionalId
    {
        return $this->id;
    }

    public function title(): Title
    {
        return $this->title;
    }

    public function passage(): Passage
    {
        return $this->passage;
    }

    public function authorId(): AuthorId
    {
        return $this->authorId;
    }

    public function publisherId(): PublisherId
    {
        return $this->publisherId;
    }

    public function content(): Content
    {
        return $this->content;
    }

    public function bibleReading(): ?string
    {
        return $this->bibleReading;
    }

    public function audioUrl(): ?Url
    {
        return $this->audioUrl;
    }

    /**
     * @return TopicId[]
     */
    public function topics(): array
    {
        return $this->topics;
    }

    public function status(): DevotionalStatus
    {
        return $this->status;
    }
}
