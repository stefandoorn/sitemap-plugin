<?php

declare(strict_types=1);

namespace Tests\SitemapPlugin\Controller;

final class SitemapProductControllerApiTest extends XmlApiTestCase
{
    public function testShowActionResponse()
    {
        $this->loadFixturesFromFiles(['channel.yaml', 'product.yaml']);
        self::generateSitemaps();

        $response = $this->getResponse('/sitemap/products.xml');
        $this->assertResponse($response, 'show_sitemap_products');
        $this->deleteSitemaps();
    }
}
