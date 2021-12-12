<?php

declare(strict_types=1);

namespace Tests\SitemapPlugin\Builder\Controller;

final class SitemapTaxonControllerApiLocalesTest extends XmlApiTestCase
{
    public function testShowActionResponse()
    {
        $this->loadFixturesFromFiles(['channel.yaml', 'taxon_locale.yaml']);
        $this->generateSitemaps();
        $response = $this->getBufferedResponse('/sitemap/taxons.xml');

        $this->assertResponse($response, 'show_sitemap_taxons_locale');
        $this->deleteSitemaps();
    }
}
