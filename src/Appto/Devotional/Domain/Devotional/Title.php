<?php

declare(strict_types=1);

namespace Appto\Devotional\Domain\Devotional;

use Appto\Common\Domain\StringValueObject;

class Title extends StringValueObject
{
    protected function guard(string $value): void
    {
        if (empty($value)) {
            throw new InvalidTitleException($value);
        }
    }
}
