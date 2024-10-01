<?php

declare(strict_types=1);

namespace Tests\SitemapPlugin\Controller;

final class SitemapStaticControllerApiTest extends XmlApiTestCase
{
    public function testShowActionResponse()
    {
        $this->loadFixturesFromFiles(['channel.yaml']);
        $this->generateSitemaps();
        $response = $this->getResponse('/sitemap/static.xml');

        $this->assertResponse($response, 'show_sitemap_static');
        $this->deleteSitemaps();
    }
}
