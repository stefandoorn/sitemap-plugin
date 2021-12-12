<?php

declare(strict_types=1);

namespace Tests\SitemapPlugin\Builder\Controller;

final class SitemapProductControllerApiLocalesImagesTest extends XmlApiTestCase
{
    public function testShowActionResponse()
    {
        $this->loadFixturesFromFiles(['channel.yaml', 'product_locale_image.yaml']);
        $this->generateSitemaps();
        $response = $this->getBufferedResponse('/sitemap/products.xml');

        $this->assertResponse($response, 'show_sitemap_products_locale_image');
        $this->deleteSitemaps();
    }
}
