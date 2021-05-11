<?php

namespace Test\Unit\Appto\Devotional\Domain\Plan;

use Appto\Common\Domain\DateTime\Year;
use Appto\Common\Infrastructure\PHPUnit\Mother\UuidMother;
use Appto\Common\Infrastructure\PHPUnit\UnitTest;
use Appto\Devotional\Domain\Plan\DailyDevotionalNotFoundException;
use Appto\Devotional\Domain\Plan\DevotionalId;
use Appto\Devotional\Domain\Plan\Title;
use Appto\Devotional\Domain\Plan\Exception\DevotionalIdAlreadyExistsException;
use Appto\Devotional\Domain\Plan\Exception\CannotRemoveDevotionalDoesNotTheLastException;
use Appto\Devotional\Domain\Plan\Exception\InvalidDevotionalDayException;
use Appto\Devotional\Domain\Plan\PlanId;
use Appto\Devotional\Domain\Plan\PlanStatus;
use Appto\Devotional\Domain\Plan\YearlyPlan;
use Appto\Common\Domain\Url\Url;

class YearlyPlanTest extends UnitTest
{
    public function testCreateYearlyPlanSuccess(): void
    {
        $plan = new YearlyPlan(
            new PlanId($this->faker->uuid),
            new Year($this->faker->year),
            new Title($this->faker->title),
            new Url($this->faker->url)
        );

        self::assertTrue($plan->dailyDevotionals()->isEmpty());
        self::assertEquals(PlanStatus::created(), $plan->status());
    }

    public function testAddDailyDevotionalSuccess(): void
    {
        $plan = YearlyPlanMother::random();
        $plan->addDailyDevotional(UuidMother::random(DevotionalId::class), 1);
        $plan->addDailyDevotional(UuidMother::random(DevotionalId::class), 2);
        $plan->addDailyDevotional(UuidMother::random(DevotionalId::class), 3);

        self::assertEquals(3, \count($plan->dailyDevotionals()));
    }

    public function testAddDailyDevotionalFailWithRepeatedDevotionalId(): void
    {
        $this->expectException(DevotionalIdAlreadyExistsException::class);

        $plan = YearlyPlanMother::random();
        $devotionalId = UuidMother::random(DevotionalId::class);
        $plan->addDailyDevotional($devotionalId, 1);
        $plan->addDailyDevotional($devotionalId, 2);
    }

    public function testAddDailyDevotionalFailWhenDayIsNotTheNextDay(): void
    {
        $this->expectException(InvalidDevotionalDayException::class);

        $plan = YearlyPlanMother::random();
        $plan->addDailyDevotional(UuidMother::random(DevotionalId::class), 1);
        $plan->addDailyDevotional(UuidMother::random(DevotionalId::class), 3);
    }

    public function testAddDailyDevotionalFailWhenDayIsNotTheFirstDay(): void
    {
        $this->expectException(InvalidDevotionalDayException::class);

        $plan = YearlyPlanMother::random();
        $plan->addDailyDevotional(UuidMother::random(DevotionalId::class), 5);
    }

    public function testSuccessfullyRemoveTheLastDailyDevotional(): void
    {
        $plan = YearlyPlanMother::random();
        $plan->addDailyDevotional(UuidMother::random(DevotionalId::class), 1);
        $plan->addDailyDevotional(UuidMother::random(DevotionalId::class), 2);
        $devotionalId = UuidMother::random(DevotionalId::class);
        $plan->addDailyDevotional($devotionalId, 3);

        $plan->removeDailyDevotional($devotionalId);

        self::assertEquals(2, \count($plan->dailyDevotionals()));
    }

    public function testFailsRemoveANonLastDailyDevotional(): void
    {
        $this->expectException(CannotRemoveDevotionalDoesNotTheLastException::class);

        $plan = YearlyPlanMother::random();
        $plan->addDailyDevotional(UuidMother::random(DevotionalId::class), 1);
        $devotionalId = UuidMother::random(DevotionalId::class);
        $plan->addDailyDevotional($devotionalId, 2);
        $plan->addDailyDevotional(UuidMother::random(DevotionalId::class), 3);

        $plan->removeDailyDevotional($devotionalId);
    }

    public function testFailsRemoveANonExistingDailyDevotional(): void
    {
        $this->expectException(DailyDevotionalNotFoundException::class);

        $plan = YearlyPlanMother::random();
        $plan->addDailyDevotional(UuidMother::random(DevotionalId::class), 1);
        $plan->addDailyDevotional(UuidMother::random(DevotionalId::class), 2);
        $nonExistingDevotionalId = UuidMother::random(DevotionalId::class);


        $plan->removeDailyDevotional($nonExistingDevotionalId);
    }
}
