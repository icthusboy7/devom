<?php

namespace Test\Unit\Appto\Common\Domain\Url;

use Appto\Common\Domain\Url\InvalidUrlException;
use Appto\Common\Domain\Url\Url;
use Appto\Common\Infrastructure\PHPUnit\UnitTest;

class UrlTest extends UnitTest
{
    public function testCreateUrlSuccess(): void
    {
        $url = new Url($this->faker->url);
        self::assertNotNull($url->value());
    }

    /**
     * @dataProvider invalidUrlProvider
     */
    public function testCreateUrlFailsWithInvalidUrl($invalidUrl): void
    {
        $this->expectException(InvalidUrlException::class);
        $url = new Url($invalidUrl);
    }

    public function invalidUrlProvider(): array
    {
        return [
            ['www..eu'],
            ['.eu'],
            ['abc'],
            ['www.prueba']
        ];
    }
}
