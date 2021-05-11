<?php

namespace Appto\Common\Domain\DateTime;

use Appto\Common\Domain\IntegerValueObject;

class Year extends IntegerValueObject
{
    protected function guard(int $value): void
    {
        if ($value < 0) {
            throw new InvalidYearException($value);
        }
    }

    public function isLeapYear(): bool
    {
        return $this->value % 4 == 0
            && $this->value % 400 == 0;
    }
}
