<?php

declare(strict_types=1);

namespace Tests\SitemapPlugin\Exception;

use PHPUnit\Framework\TestCase;
use SitemapPlugin\Exception\SitemapUrlNotFoundException;
use SitemapPlugin\Model\Url;

final class SitemapUrlNotFoundExceptionTest extends TestCase
{
    public function testException(): void
    {
        $sitemapUrl = new Url('location');
        $sitemapUrl->setLocation('test');

        $exception = new SitemapUrlNotFoundException($sitemapUrl);

        self::assertSame('Sitemap url "test" not found', $exception->getMessage());
    }
}
