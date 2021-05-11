<?php

declare(strict_types=1);

namespace Appto\Common\Domain\DateTime;

class YearlyDay
{
    private $year;
    private $value;

    public function __construct(Year $year, int $day)
    {
        $this->guard($year, $day);
        $this->year = $year;
        $this->value = $day;
    }

    protected function guard(Year $year, int $day): void
    {
        if ($day < 1 || $day > 366 || (!$year->isLeapYear() && $day > 365)) {
            throw new InvalidYearlyDayException($day);
        }
    }

    public function equals(YearlyDay $other): bool
    {
        return $this->year->equals($other->year()) && $this->value == $other->value();
    }

    public function year(): Year
    {
        return $this->year;
    }

    public function value(): int
    {
        return $this->value;
    }
}
