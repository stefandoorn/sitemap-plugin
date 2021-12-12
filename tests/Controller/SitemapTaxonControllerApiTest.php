<?php

declare(strict_types=1);

namespace Tests\SitemapPlugin\Builder\Controller;

final class SitemapTaxonControllerApiTest extends XmlApiTestCase
{
    public function testShowActionResponse()
    {
        $this->loadFixturesFromFiles(['channel.yaml', 'taxon.yaml']);
        $this->generateSitemaps();
        $response = $this->getBufferedResponse('/sitemap/taxons.xml');

        $this->assertResponse($response, 'show_sitemap_taxons');
        $this->deleteSitemaps();
    }
}
