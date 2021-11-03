<?php

declare(strict_types=1);

namespace Tests\StefanDoorn\SyliusSitemapPlugin\Controller;

final class MultiChannelSitemapStaticControllerApiTest extends XmlApiTestCase
{
    public function testShowActionResponse()
    {
        $this->loadFixturesFromFiles(['multi_channel.yaml']);
        $this->generateSitemaps();

        $response = $this->getBufferedResponse('http://store.fr/sitemap/static.xml');

        $this->assertResponse($response, 'show_sitemap_static_fr');
    }
}
