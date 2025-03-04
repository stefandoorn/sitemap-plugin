<?php

declare(strict_types=1);

namespace Tests\SitemapPlugin\Controller;

final class SitemapProductControllerApiLocalesTest extends XmlApiTestCase
{
    public function testShowActionResponse()
    {
        $this->loadFixturesFromFiles(['channel.yaml', 'product_locale.yaml']);
        self::generateSitemaps();
        $response = $this->getResponse('/sitemap/products.xml');
        $this->assertResponse($response, 'show_sitemap_products_locale');
        $this->deleteSitemaps();
    }
}
