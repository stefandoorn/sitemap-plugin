<?php

declare(strict_types=1);

namespace Tests\SitemapPlugin\Model;

use PHPUnit\Framework\TestCase;
use SitemapPlugin\Model\Sitemap;
use SitemapPlugin\Model\Url;

final class SitemapTest extends TestCase
{
    public function testInit(): void
    {
        $obj = new Sitemap();

        self::assertEmpty($obj->getUrls());
        self::assertNull($obj->getLocalization());
        self::assertNull($obj->getLastModification());
    }

    public function testUrls(): void
    {
        $obj = new Sitemap();

        $sitemapUrl = new Url('location');
        $sitemapUrl->setLocation('url');

        $sitemapUrlTwo = new Url('location');
        $sitemapUrlTwo->setLocation('url2');

        $obj->addUrl($sitemapUrl);

        self::assertCount(1, $obj->getUrls());
        self::assertTrue(\is_iterable($obj->getUrls()));
        self::assertEquals([$sitemapUrl], $obj->getUrls());

        $obj->setUrls([$sitemapUrl, $sitemapUrlTwo]);

        self::assertCount(2, $obj->getUrls());
        self::assertTrue(\is_iterable($obj->getUrls()));
        self::assertEquals([$sitemapUrl, $sitemapUrlTwo], $obj->getUrls());

        $obj->removeUrl($sitemapUrlTwo);

        self::assertCount(1, $obj->getUrls());
        self::assertTrue(\is_iterable($obj->getUrls()));
        self::assertEquals([$sitemapUrl], $obj->getUrls());
    }

    public function testLocalization(): void
    {
        $obj = new Sitemap();
        $obj->setLocalization('test');

        self::assertEquals('test', $obj->getLocalization());
    }

    public function testModificationDate(): void
    {
        $obj = new Sitemap();
        $date = new \DateTimeImmutable();
        $obj->setLastModification($date);

        self::assertEquals($date, $obj->getLastModification());
    }
}
