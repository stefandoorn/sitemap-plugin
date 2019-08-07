<?php

declare(strict_types=1);

namespace Tests\SitemapPlugin\Controller;

final class SitemapStaticControllerApiTest extends AbstractTestController
{
    use TearDownTrait;

    public function testShowActionResponse()
    {
        $this->generateSitemaps();

        $this->client->request('GET', '/sitemap/static.xml');

        $response = $this->getResponse();

        $this->assertResponse($response, 'show_sitemap_static');
    }
}
