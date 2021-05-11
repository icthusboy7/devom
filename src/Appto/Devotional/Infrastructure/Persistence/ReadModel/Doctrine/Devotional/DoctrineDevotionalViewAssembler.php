<?php

declare(strict_types=1);

namespace Appto\Devotional\Infrastructure\Persistence\ReadModel\Doctrine\Devotional;

use Appto\Devotional\Domain\Devotional\Devotional;
use Appto\Devotional\Domain\Devotional\TopicId;
use Appto\Devotional\View\Devotional\DevotionalView;
use Appto\Devotional\View\Devotional\DevotionalViewAssembler;
use Appto\Devotional\View\Devotional\PassageView;

class DoctrineDevotionalViewAssembler implements DevotionalViewAssembler
{
    public function assemble(Devotional $devotional): DevotionalView
    {
        return new DevotionalView(
            (string)$devotional->id(),
            (string)$devotional->title(),
            new PassageView($devotional->passage()->text(), $devotional->passage()->reference()),
            (string)$devotional->content(),
            $devotional->bibleReading(),
            $devotional->audioUrl() ? (string)$devotional->audioUrl() : null,
            $this->assembleTopicIds($devotional->topics()),
            $devotional->status()->value(),
            (string)$devotional->authorId(),
            (string)$devotional->publisherId()
        );
    }

    /**
     * @param TopicId[] $topics
     * @return string[]
     */
    private function assembleTopicIds(array $topics): array
    {
        return array_map(
            fn(TopicId $topicId) => (string)$topicId,
            $topics
        );
    }
}
