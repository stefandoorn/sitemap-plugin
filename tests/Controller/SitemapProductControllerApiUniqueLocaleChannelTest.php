<?php

declare(strict_types=1);

namespace Tests\SitemapPlugin\Builder\Controller;

final class SitemapProductControllerApiUniqueLocaleChannelTest extends XmlApiTestCase
{
    public function testShowActionResponse()
    {
        $this->loadFixturesFromFiles(['product_unique_locale_channel.yaml']);
        $this->generateSitemaps();

        $response = $this->getBufferedResponse('/sitemap/products.xml');

        $this->assertResponse($response, 'show_sitemap_products_unique_channel_locale');
        $this->deleteSitemaps();
    }
}
