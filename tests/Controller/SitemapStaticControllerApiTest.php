<?php

declare(strict_types=1);

namespace Tests\SitemapPlugin\Controller;

final class SitemapStaticControllerApiTest extends AbstractTestController
{
    use TearDownTrait;

    public function testShowActionResponse()
    {
        $this->client->request('GET', '/sitemap/static.xml');

        $response = $this->client->getResponse();

        $this->assertResponse($response, 'show_sitemap_static');
    }
}
