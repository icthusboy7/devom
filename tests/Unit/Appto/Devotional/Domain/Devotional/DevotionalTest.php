<?php

namespace Test\Unit\Appto\Devotional\Application\Command\Devotional;

use Appto\Common\Infrastructure\PHPUnit\UnitTest;
use Appto\Devotional\Domain\Devotional\DevotionalCreated;
use Appto\Devotional\Domain\Devotional\DevotionalStatus;
use Test\Unit\Appto\Devotional\Domain\Devotional\DevotionalMother;

class DevotionalTest extends UnitTest
{
    public function testCreateDevotional(): void
    {
        $devotional = DevotionalMother::random();

        $events = $devotional->uncommittedEvents()->events();

        self::assertEquals(DevotionalStatus::created(), $devotional->status());
        self::assertCount(1, $events);
        self::assertInstanceOf(DevotionalCreated::class, $events[0]);
    }

    public function testCreateDevotionalWithoutTopics(): void
    {
        $devotional = DevotionalMother::randomWithTopics([]);

        $events = $devotional->uncommittedEvents()->events();

        self::assertEmpty($devotional->topics());
        self::assertEquals(DevotionalStatus::created(), $devotional->status());
        self::assertCount(1, $events);
        self::assertInstanceOf(DevotionalCreated::class, $events[0]);
    }
}
