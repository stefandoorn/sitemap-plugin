<?php

declare(strict_types=1);

namespace Tests\StefanDoorn\SyliusSitemapPlugin\Model;

use PHPUnit\Framework\TestCase;
use StefanDoorn\SyliusSitemapPlugin\Model\Sitemap;
use StefanDoorn\SyliusSitemapPlugin\Model\Url;

final class SitemapTest extends TestCase
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

        $sitemapUrl = new Url('location');
        $sitemapUrl->setLocation('url');

        $sitemapUrlTwo = new Url('location');
        $sitemapUrlTwo->setLocation('url2');

        $obj->addUrl($sitemapUrl);

        $this->assertCount(1, $obj->getUrls());
        $this->assertTrue(\is_iterable($obj->getUrls()));
        $this->assertEquals([$sitemapUrl], $obj->getUrls());

        $obj->setUrls([$sitemapUrl, $sitemapUrlTwo]);

        $this->assertCount(2, $obj->getUrls());
        $this->assertTrue(\is_iterable($obj->getUrls()));
        $this->assertEquals([$sitemapUrl, $sitemapUrlTwo], $obj->getUrls());

        $obj->removeUrl($sitemapUrlTwo);

        $this->assertCount(1, $obj->getUrls());
        $this->assertTrue(\is_iterable($obj->getUrls()));
        $this->assertEquals([$sitemapUrl], $obj->getUrls());
    }

    public function testLocalization()
    {
        $obj = new Sitemap();

        $obj->setLocalization('test');
        $this->assertEquals('test', $obj->getLocalization());
    }

    public function testModificationDate()
    {
        $obj = new Sitemap();
        $date = new \DateTimeImmutable();

        $obj->setLastModification($date);
        $this->assertEquals($date, $obj->getLastModification());
    }
}
