<?php

declare(strict_types=1);

namespace Appto\Common\Domain\Url;

use Appto\Common\Domain\Nullable;
use Appto\Common\Domain\StringValueObject;

class Url extends StringValueObject implements Nullable
{
    protected function guard(string $value): void
    {
        if (preg_match('#^https?://#i', $value) != 1) {
            throw new InvalidUrlException($value);
        }
    }

    public function isNull(): bool
    {
        return null == $this->value;
    }
}
