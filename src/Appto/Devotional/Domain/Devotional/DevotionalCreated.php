<?php

declare(strict_types=1);

namespace Appto\Devotional\Domain\Devotional;

use Appto\Common\Domain\Serializable;
use Appto\Common\Domain\Url\Url;

class DevotionalCreated extends DevotionalEvent implements Serializable
{
    private const EVENT_NAME = 'appto.devom.1.event.devotional.created';

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

    public function __construct(
        DevotionalId $id,
        Title $title,
        Content $content,
        ?string $bibleReading,
        ?Url $audioUrl,
        AuthorId $authorId,
        PublisherId $publisherId,
        Passage $passage,
        ?array $topics,
        DevotionalStatus $status
    ) {
        $this->id = $id;
        $this->title = $title;
        $this->content = $content;
        $this->bibleReading = $bibleReading;
        $this->audioUrl = $audioUrl;
        $this->authorId = $authorId;
        $this->publisherId = $publisherId;
        $this->passage = $passage;
        $this->topics = $topics;
        $this->status = $status;

        parent::__construct();
    }

    public function eventName(): string
    {
        return self::EVENT_NAME;
    }

    public static function deserialize(array $data): self
    {
        $fields = [
            'id',
            'title',
            'content',
            'bibleReading',
            'audioUrl',
            'authorId',
            'publisherId',
            'passageText',
            'passageReference',
            'topics',
            'status',
        ];
        if (!empty(array_diff($fields, array_keys($data)))) {
            throw new \InvalidArgumentException();
        }

        $audioUrl = $data['audioUrl'] ? new Url($data['audioUrl']) : null;
        $passage = !empty($data['passageText']) && !empty($data['passageReference'])
            ? new Passage($data['passageText'], $data['passageReference'])
            : null;
        $topics = $data['topics']
            ? array_map(function (string $topicId) {
                return new TopicId($topicId);
            }, $data['topics'])
            : [];

        return new self(
            new DevotionalId($data['id']),
            new Title($data['title']),
            new Content($data['content']),
            $data['bibleReading'],
            $audioUrl,
            new AuthorId($data['authorId']),
            new PublisherId($data['publisherId']),
            $passage,
            $topics,
            new DevotionalStatus($data['status'])
        );
    }

    public function serialize(): array
    {
        $topics = array_map(function (string $topicId) {
            return $topicId;
        }, $this->topics());

        return [
            'id' => (string)$this->id(),
            'title' => (string)$this->title(),
            'content' => (string)$this->content(),
            'bibleReading' => $this->bibleReading(),
            'audioUrl' => $this->audioUrl() ? (string)$this->audioUrl() : null,
            'authorId' => (string)$this->authorId(),
            'publisherId' => (string)$this->publisherId(),
            'passageText' => (string)$this->passage()->text(),
            'passageReference' => (string)$this->passage()->reference(),
            'topics' => $topics,
            'status' => $this->status()->value(),
        ];
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

    public function authorId(): AuthorId
    {
        return $this->authorId;
    }

    public function publisherId(): PublisherId
    {
        return $this->publisherId;
    }

    public function topics(): array
    {
        return $this->topics;
    }

    public function status(): DevotionalStatus
    {
        return $this->status;
    }
}
