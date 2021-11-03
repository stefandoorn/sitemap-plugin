<?php

declare(strict_types=1);

namespace Tests\StefanDoorn\SyliusSitemapPlugin\Controller;

final class SitemapProductControllerApiImagesTest extends XmlApiTestCase
{
    public function testShowActionResponse()
    {
        $this->loadFixturesFromFiles(['channel.yaml', 'product_images.yaml']);
        $this->generateSitemaps();
        $response = $this->getBufferedResponse('/sitemap/products.xml');

        $this->assertResponse($response, 'show_sitemap_products_image');
        $this->deleteSitemaps();
    }
}
