<?php

declare(strict_types=1);

namespace Tests\SitemapPlugin\Model;

use PHPUnit\Framework\TestCase;
use SitemapPlugin\Model\Sitemap;
use SitemapPlugin\Model\SitemapUrl;

/**
 * Class SitemapTest
 */
class SitemapTest extends TestCase
{
    public function testInit()
    {
        $obj = new Sitemap();

        $this->assertEmpty($obj->getUrls());
        $this->assertNull($obj->getLocalization());
        $this->assertNull($obj->getLastModification());
    }

    public function testUrls()
    {
        $obj = new Sitemap();

        $sitemapUrl = new SitemapUrl();
        $sitemapUrl->setLocalization('url');

        $sitemapUrlTwo = new SitemapUrl();
        $sitemapUrlTwo->setLocalization('url2');

        $this->assertNull($obj->addUrl($sitemapUrl));

        $this->assertCount(1, $obj->getUrls());
        $this->assertTrue(is_iterable($obj->getUrls()));
        $this->assertEquals([$sitemapUrl], $obj->getUrls());

        $this->assertNull($obj->setUrls([$sitemapUrl, $sitemapUrlTwo]));

        $this->assertCount(2, $obj->getUrls());
        $this->assertTrue(is_iterable($obj->getUrls()));
        $this->assertEquals([$sitemapUrl, $sitemapUrlTwo], $obj->getUrls());

        $this->assertNull($obj->removeUrl($sitemapUrlTwo));

        $this->assertCount(1, $obj->getUrls());
        $this->assertTrue(is_iterable($obj->getUrls()));
        $this->assertEquals([$sitemapUrl], $obj->getUrls());
    }

    public function testLocalization()
    {
        $obj = new Sitemap();

        $this->assertNull($obj->setLocalization('test'));
        $this->assertEquals('test', $obj->getLocalization());
    }

    public function testModificationDate()
    {
        $obj = new Sitemap();
        $date = new \DateTimeImmutable();

        $this->assertNull($obj->setLastModification($date));
        $this->assertEquals($date, $obj->getLastModification());
    }
}
