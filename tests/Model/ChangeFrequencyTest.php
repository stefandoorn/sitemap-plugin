<?php

declare(strict_types=1);

namespace Tests\SitemapPlugin\Model;

use PHPUnit\Framework\TestCase;
use SitemapPlugin\Model\ChangeFrequency;

final class ChangeFrequencyTest extends TestCase
{
    /**
     * @dataProvider dataProvider
     */
    public function testBasic($interval): void
    {
        $obj = ChangeFrequency::$interval();
        $castedString = (string) $obj;
        $toString = $obj->__toString();

        self::assertSame($interval, $castedString);
        self::assertSame($interval, $toString);
    }

    public static function dataProvider(): array
    {
        return [
            ['daily'],
            ['always'],
            ['hourly'],
            ['weekly'],
            ['monthly'],
            ['yearly'],
            ['never'],
        ];
    }
}
