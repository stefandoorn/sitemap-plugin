<?php

namespace Tests\SitemapPlugin\Exception;

use SitemapPlugin\Exception\RouteExistsException;
use SitemapPlugin\Exception\SitemapUrlNotFoundException;
use SitemapPlugin\Model\SitemapUrl;

/**
 * @author Stefan Doorn <stefan@efectos.nl>
 */
class SitemapUrlNotFoundExceptionTest extends \PHPUnit_Framework_TestCase
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
