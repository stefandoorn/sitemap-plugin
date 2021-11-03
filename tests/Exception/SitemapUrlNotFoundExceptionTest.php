<?php

declare(strict_types=1);

namespace Tests\StefanDoorn\SyliusSitemapPlugin\Exception;

use PHPUnit\Framework\TestCase;
use StefanDoorn\SyliusSitemapPlugin\Exception\SitemapUrlNotFoundException;
use StefanDoorn\SyliusSitemapPlugin\Model\Url;

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
