<?php

declare(strict_types=1);

namespace Test\Unit\Appto\Common\Domain\DateTime;

use Appto\Common\Domain\DateTime\InvalidYearlyDayException;
use Appto\Common\Domain\DateTime\Year;
use Appto\Common\Domain\DateTime\YearlyDay;
use Appto\Common\Infrastructure\PHPUnit\UnitTest;

class YearlyDayTest extends UnitTest
{

    public function testCreateYearlyDaySuccess(): void
    {
        $day = $this->faker->numberBetween(1, 365);
        $yearlyDay = new YearlyDay(new Year(2020), $day);

        self::assertEquals($day, $yearlyDay->value());
    }

    /**
     * @dataProvider invalidDayProvider
     */
    public function testCreateYearlyDayFailWithInvalidDay($invalidDay): void
    {
        $this->expectException(InvalidYearlyDayException::class);

        $year = new YearlyDay(new Year((int)$this->faker->year), $invalidDay);
    }

    /**
     * @dataProvider leapYearProvider
     */
    public function testCreateDay366WithLeapYear($leapYear): void
    {
        $day = 366;
        $yearlyDay = new YearlyDay(new Year($leapYear), $day);

        self::assertEquals($day, $yearlyDay->value());
    }

    /**
     * @dataProvider nonLeapYearProvider
     */
    public function testCreateDay366FailWithNonLeapYear($nonLeapYear): void
    {
        $this->expectException(InvalidYearlyDayException::class);

        $day = 366;
        $yearlyDay = new YearlyDay(new Year($nonLeapYear), $day);
    }

    public function invalidDayProvider(): array
    {
        return [
            [-1],
            [0],
            [367],
            [1000],
        ];
    }

    public function leapYearProvider(): array
    {
        return [
            [2000],
            [2400],
            [2800],
        ];
    }

    public function nonLeapYearProvider(): array
    {
        return [
            [1900],
            [2100],
            [2200],
            [2300],
            [2020],
        ];
    }
}
