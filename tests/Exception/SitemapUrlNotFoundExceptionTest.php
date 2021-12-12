<?php

declare(strict_types=1);

namespace Tests\SitemapPlugin\Builder\Exception;

use PHPUnit\Framework\TestCase;
use SitemapPlugin\Builder\Exception\SitemapUrlNotFoundException;
use SitemapPlugin\Builder\Model\Url;

final class SitemapUrlNotFoundExceptionTest extends TestCase
{
    public function testException()
    {
        $sitemapUrl = new Url('location');
        $sitemapUrl->setLocation('test');

        $exception = new SitemapUrlNotFoundException($sitemapUrl);
        $this->assertSame('Sitemap url "test" not found', $exception->getMessage());
    }
}
