<?php

namespace Tests\SitemapPlugin\Exception;

use PHPUnit\Framework\TestCase;
use SitemapPlugin\Exception\SitemapUrlNotFoundException;
use SitemapPlugin\Model\SitemapUrl;

/**
 * @author Stefan Doorn <stefan@efectos.nl>
 */
class SitemapUrlNotFoundExceptionTest extends TestCase
{
    /**
     *
     */
    public function testException()
    {
        $sitemapUrl = new SitemapUrl();
        $sitemapUrl->setLocalization('test');

        $exception = new SitemapUrlNotFoundException($sitemapUrl);
        $this->assertSame('Sitemap url "test" not found', $exception->getMessage());
    }
}
