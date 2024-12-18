<?php

declare(strict_types=1);

namespace Tests\SitemapPlugin\Controller;

final class MultiChannelSitemapIndexControllerApiTest extends XmlApiTestCase
{
    public function testShowActionResponse()
    {
        $this->loadFixturesFromFiles(['multi_channel.yaml']);
        $this->generateSitemaps();

        $response = $this->getResponse('http://localhost/sitemap_index.xml');
        $this->assertResponse($response, 'show_sitemap_index');

        $response = $this->getResponse('http://store.fr/sitemap_index.xml');
        $this->assertResponse($response, 'show_second_sitemap_index');

        $this->deleteSitemaps();
    }
}
