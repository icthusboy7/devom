<?php

declare(strict_types=1);

namespace Appto\Devotional\Domain\Devotional;

use Appto\Common\Domain\IntegerValueObject;

class DevotionalStatus extends IntegerValueObject
{
    private const CREATED = 100;
    private const PENDING_REVIEW = 110;
    private const APPROVED = 200;
    private const PUBLISHED = 300;
    private const REMOVED = 400;

    public function isPublished(): bool
    {
        return self::PUBLISHED == $this->value;
    }

    public function isApproved(): bool
    {
        return self::APPROVED == $this->value;
    }

    public static function published(): self
    {
        return new DevotionalStatus(self::PUBLISHED);
    }

    public static function created(): self
    {
        return new DevotionalStatus(self::CREATED);
    }

    public static function approved(): self
    {
        return new DevotionalStatus(self::APPROVED);
    }

    protected function guard(int $value): void
    {
        // WIP: Implement guard() method.
    }
}
