<?php

declare(strict_types=1);

namespace Tests\SitemapPlugin\Exception;

use PHPUnit\Framework\TestCase;
use SitemapPlugin\Exception\RouteExistsException;

final class RouteExistsExceptionTest extends TestCase
{
    public function testException(): void
    {
        $exception = new RouteExistsException('test');

        self::assertSame('Sitemap route "test" already exists, probably a provider with a non-unique name', $exception->getMessage());
    }
}
