<?php

namespace Tests\SitemapPlugin\Exception;

use PHPUnit\Framework\TestCase;
use SitemapPlugin\Exception\RouteExistsException;

/**
 * @author Stefan Doorn <stefan@efectos.nl>
 */
class RouteExistsExceptionTest extends TestCase
{
    /**
     *
     */
    public function testException()
    {
        $exception = new RouteExistsException('test');
        $this->assertSame('Sitemap route "test" already exists, probably a provider with a non-unique name', $exception->getMessage());
    }
}
