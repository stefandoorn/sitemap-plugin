<?php

declare(strict_types=1);

namespace Tests\SitemapPlugin\Builder\Exception;

use PHPUnit\Framework\TestCase;
use SitemapPlugin\Builder\Exception\RouteExistsException;

final class RouteExistsExceptionTest extends TestCase
{
    public function testException()
    {
        $exception = new RouteExistsException('test');
        $this->assertSame('Sitemap route "test" already exists, probably a provider with a non-unique name', $exception->getMessage());
    }
}
