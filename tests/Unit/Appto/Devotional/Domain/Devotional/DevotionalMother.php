<?php

namespace Test\Unit\Appto\Devotional\Domain\Devotional;

use Appto\Common\Infrastructure\PHPUnit\Mother;
use Appto\Common\Infrastructure\PHPUnit\Mother\CollectionMother;
use Appto\Common\Infrastructure\PHPUnit\Mother\UuidMother;
use Appto\Devotional\Domain\Devotional\Content;
use Appto\Devotional\Domain\Devotional\Devotional;
use Appto\Devotional\Domain\Devotional\DevotionalId;
use Appto\Devotional\Domain\Devotional\Passage;
use Appto\Devotional\Domain\Devotional\Title;
use Appto\Common\Domain\Url\Url;
use Appto\Devotional\Domain\Devotional\AuthorId;
use Appto\Devotional\Domain\Devotional\PublisherId;
use Appto\Devotional\Domain\Devotional\TopicId;

class DevotionalMother extends Mother
{
    public static function create(
        string $id,
        string $title,
        string $content,
        ?string $bibleReading,
        ?string $audioUrl,
        string $authorId,
        string $publisherId,
        array $topics,
        Passage $passage
    ): Devotional {
        return new Devotional(
            new DevotionalId($id),
            new Title($title),
            new Content($content),
            $bibleReading,
            $audioUrl ? new Url($audioUrl) : null,
            new AuthorId($authorId),
            new PublisherId($publisherId),
            $passage,
            $topics
        );
    }

    public static function random(): Devotional
    {
        return self::create(
            self::faker()->uuid,
            self::faker()->title,
            self::faker()->paragraph,
            self::faker()->paragraph,
            self::faker()->url,
            self::faker()->uuid,
            self::faker()->uuid,
            CollectionMother::elements([UuidMother::class, 'random'], TopicId::class),
            new Passage(
                self::faker()->text,
                self::faker()->word
            )
        );
    }

    public static function randomWithTopics(array $topics): Devotional
    {
        return self::create(
            self::faker()->uuid,
            self::faker()->title,
            self::faker()->paragraph,
            self::faker()->paragraph,
            self::faker()->url,
            self::faker()->uuid,
            self::faker()->uuid,
            $topics,
            new Passage(
                self::faker()->text,
                self::faker()->word
            )
        );
    }

    public static function randomWithBibleReading(?string $bibleReading): Devotional
    {
        return self::create(
            self::faker()->uuid,
            self::faker()->title,
            self::faker()->paragraph,
            $bibleReading,
            self::faker()->url,
            self::faker()->uuid,
            self::faker()->uuid,
            CollectionMother::elements([UuidMother::class, 'random'], TopicId::class),
            new Passage(
                self::faker()->text,
                self::faker()->word
            )
        );
    }

    public static function randomWithAudioUrl(?string $audioUrl): Devotional
    {
        return self::create(
            self::faker()->uuid,
            self::faker()->title,
            self::faker()->paragraph,
            self::faker()->paragraph,
            $audioUrl,
            self::faker()->uuid,
            self::faker()->uuid,
            CollectionMother::elements([UuidMother::class, 'random'], TopicId::class),
            new Passage(
                self::faker()->text,
                self::faker()->word
            )
        );
    }
}
