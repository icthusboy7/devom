<?php

declare(strict_types=1);

namespace Appto\Devotional\Infrastructure\Persistence\ReadModel\Doctrine\Plan;

use Appto\Devotional\Domain\Devotional\TopicId;
use Appto\Devotional\View\Devotional\DevotionalView;
use Appto\Devotional\View\Plan\DailyDevotionalView;
use Appto\Devotional\View\Plan\DailyDevotionalViewAssembler;
use Appto\Devotional\View\Devotional\PassageView;

class DoctrineDailyDevotionalViewAssembler implements DailyDevotionalViewAssembler
{
    public function assemble(\stdClass $dailyDevotional): DailyDevotionalView
    {
        return new DailyDevotionalView(
            new DevotionalView(
                $dailyDevotional->id,
                $dailyDevotional->title,
                new PassageView($dailyDevotional->passageText, $dailyDevotional->passageReference),
                $dailyDevotional->content,
                $dailyDevotional->bibleReading,
                $dailyDevotional->audioUrl ? $dailyDevotional->audioUrl : null,
                $this->assembleTopicIds(json_decode($dailyDevotional->topics)),
                (int)$dailyDevotional->status,
                $dailyDevotional->authorId,
                $dailyDevotional->publisherId
            ),
            (int)$dailyDevotional->day
        );
    }

    /**
     * @param TopicId[] $topics
     * @return string[]
     */
    private function assembleTopicIds(array $topics): array
    {
        return array_map(
            fn(string $topicId) => $topicId,
            $topics
        );
    }
}
