<?php

namespace Test\Unit\Appto\Common\Domain\DateTime;

use Appto\Common\Domain\DateTime\InvalidYearException;
use Appto\Common\Domain\DateTime\Year;
use Appto\Common\Infrastructure\PHPUnit\UnitTest;

class YearTest extends UnitTest
{

    /**
     * @dataProvider validYearProvider
     */
    public function testCreateYearSuccess($validYear): void
    {
        $year = new Year($validYear);
        self::assertEquals($validYear, $year->value());
    }

    /**
     * @dataProvider invalidYearProvider
     */
    public function testCreateYearFailWithInvalidYear($invalidYear): void
    {
        $this->expectException(InvalidYearException::class);
        $year = new Year($invalidYear);
    }

    /**
     * @dataProvider invalidYearTypeParameterProvider
     */
    public function testCreateYearFailWithInvalidYearType($invalidYearType): void
    {
        $this->expectException(\TypeError::class);
        $year = new Year($invalidYearType);
    }

    /**
     * @dataProvider leapYearProvider
     */
    public function testLeapYear($leapYear): void
    {
        $year = new Year($leapYear);
        self::assertEquals($leapYear, $year->value());
        self::assertTrue($year->isLeapYear());
    }

    /**
     * @dataProvider nonLeapYearProvider
     */
    public function testNonLeapYear($nonLeapYear): void
    {
        $year = new Year($nonLeapYear);
        self::assertEquals($nonLeapYear, $year->value());
        self::assertFalse($year->isLeapYear());
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

    public function invalidYearTypeParameterProvider(): array
    {
        return [
            [null],
            [''],
            [12.5E32],
        ];
    }

    public function invalidYearProvider(): array
    {
        return [
            [-2020],
            [-1],
        ];
    }

    public function validYearProvider(): array
    {
        return [
            [2020],
            [1],
            [10],
            [3000],
            [0],
            [0000],
            [false],
            ['2020'],
        ];
    }
}
