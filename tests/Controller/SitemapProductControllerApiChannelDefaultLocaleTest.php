<?php

declare(strict_types=1);

namespace Tests\SitemapPlugin\Controller;

final class SitemapProductControllerApiChannelDefaultLocaleTest extends XmlApiTestCase
{
    public function testShowActionResponse(): void
    {
        $this->loadFixturesFromFiles(['channel_with_locale_different_from_default.yaml', 'product_with_locales.yaml']);
        $this->generateSitemaps();

        $response = $this->getBufferedResponse('/sitemap/products.xml');
        $this->assertResponse($response, 'show_sitemap_products_with_channel_default_locale');
        $this->deleteSitemaps();
    }
}
