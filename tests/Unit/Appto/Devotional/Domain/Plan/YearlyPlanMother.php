<?php

declare(strict_types=1);

namespace Test\Unit\Appto\Devotional\Domain\Plan;

use Appto\Common\Domain\DateTime\Year;
use Appto\Common\Infrastructure\PHPUnit\Mother;
use Appto\Devotional\Domain\Plan\PlanId;
use Appto\Devotional\Domain\Plan\YearlyPlan;
use Appto\Devotional\Domain\Plan\Title;
use Appto\Common\Domain\Url\Url;

class YearlyPlanMother extends Mother
{
    public static function create(string $id, int $year, string $title, ?string $coverPhotoUrl): YearlyPlan
    {
        return new YearlyPlan(
            new PlanId($id),
            new Year($year),
            new Title($title),
            $coverPhotoUrl ? new Url($coverPhotoUrl) : null
        );
    }

    public static function random(): YearlyPlan
    {
        return self::create(
            self::faker()->uuid,
            self::faker()->numberBetween(1, 365),
            self::faker()->title,
            self::faker()->url
        );
    }
}
