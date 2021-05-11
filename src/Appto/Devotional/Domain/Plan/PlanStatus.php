<?php

declare(strict_types=1);

namespace Appto\Devotional\Domain\Plan;

use Appto\Common\Domain\IntegerValueObject;

class PlanStatus extends IntegerValueObject
{
    private const CREATED = 100;
    private const PUBLISHED = 300;
    private const REMOVED = 400;

    public function isPublished(): bool
    {
        return self::PUBLISHED == $this->value;
    }

    public static function published(): self
    {
        return new PlanStatus(self::PUBLISHED);
    }

    public static function created(): self
    {
        return new PlanStatus(self::CREATED);
    }

    public static function removed(): self
    {
        return new PlanStatus(self::REMOVED);
    }

    protected function guard(int $value): void
    {
        // WIP: Implement guard() method.
    }
}
