<?php

declare(strict_types=1);

namespace Tests\SitemapPlugin\Controller;

final class SitemapTaxonControllerApiTest extends XmlApiTestCase
{
    public function testShowActionResponse()
    {
        $this->loadFixturesFromFiles(['channel.yaml', 'taxon.yaml']);
        self::generateSitemaps();
        $response = $this->getResponse('/sitemap/taxons.xml');

        $this->assertResponse($response, 'show_sitemap_taxons');
        $this->deleteSitemaps();
    }
}
