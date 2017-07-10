<?php

namespace Tests\SitemapPlugin\Model;

use SitemapPlugin\Model\ChangeFrequency;

/**
 * Class ChangeFrequencyTest
 * @package Tests\SitemapPlugin\Model
 */
class ChangeFrequencyTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @param $interval
     * @dataProvider dataProvider
     */
    public function testBasic($interval)
    {
        $obj = ChangeFrequency::$interval();
        $castedString = (string) $obj;
        $toString = $obj->__toString();

        $this->assertSame($interval, $castedString);
        $this->assertSame($interval, $toString);
    }

    /**
     * @return array
     */
    public function dataProvider()
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
