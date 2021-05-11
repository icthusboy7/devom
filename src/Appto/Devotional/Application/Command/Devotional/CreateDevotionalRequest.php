<?php

declare(strict_types=1);

namespace Appto\Devotional\Application\Command\Devotional;

use Appto\Common\Application\Command\Command;
use Appto\Devotional\View\Devotional\PassageView;
use Appto\Devotional\View\Devotional\TopicView;

class CreateDevotionalRequest implements Command
{
    private $devotionalId;
    private $title;
    private $passage;
    private $content;
    private $bibleReading;
    private $audioUrl;
    private $authorId;
    private $publisherId;
    private $topics;

    /**
     * @var null|TopicView[] $topics
     */
    public function __construct(
        string $devotionalId,
        string $title,
        string $content,
        ?string $bibleReading,
        ?string $audioUrl,
        string $authorId,
        string $publisherId,
        PassageView $passage,
        ?array $topics
    ) {
        $this->devotionalId = $devotionalId;
        $this->title = $title;
        $this->passage = $passage;
        $this->content = $content;
        $this->bibleReading = $bibleReading;
        $this->audioUrl = $audioUrl;
        $this->authorId = $authorId;
        $this->publisherId = $publisherId;
        $this->topics = $topics;
    }

    public function devotionalId(): string
    {
        return $this->devotionalId;
    }

    public function title(): string
    {
        return $this->title;
    }

    public function passage(): ?PassageView
    {
        return $this->passage;
    }

    public function content(): string
    {
        return $this->content;
    }

    public function bibleReading(): ?string
    {
        return $this->bibleReading;
    }

    public function audioUrl(): ?string
    {
        return $this->audioUrl;
    }

    public function authorId(): string
    {
        return $this->authorId;
    }

    public function publisherId(): string
    {
        return $this->publisherId;
    }

    /**
     * @return null|string[]
     */
    public function topics(): ?array
    {
        return $this->topics;
    }
}
