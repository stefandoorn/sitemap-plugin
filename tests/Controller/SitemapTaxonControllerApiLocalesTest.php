<?php

declare(strict_types=1);

namespace Tests\SitemapPlugin\Controller;

use Sylius\Component\Core\Model\Taxon;

final class SitemapTaxonControllerApiLocalesTest extends AbstractTestController
{
    use TearDownTrait;

    /**
     * @before
     */
    public function setUpDatabase(): void
    {
        parent::setUpDatabase();

        $root = new Taxon();
        $root->setCurrentLocale('en_US');
        $root->setName('Root');
        $root->setCode('root');
        $root->setSlug('root');
        $root->setCurrentLocale('nl_NL');
        $root->setName('Root');
        $root->setCode('root');
        $root->setSlug('root');

        $taxon = new Taxon();
        $taxon->setCurrentLocale('en_US');
        $taxon->setName('Test');
        $taxon->setCode('test-code');
        $taxon->setSlug('test');
        $taxon->setCurrentLocale('nl_NL');
        $taxon->setName('Test');
        $taxon->setCode('test-code');
        $taxon->setSlug('test');
        $taxon->setParent($root);

        $taxon = new Taxon();
        $taxon->setCurrentLocale('en_US');
        $taxon->setName('Mock');
        $taxon->setCode('mock-code');
        $taxon->setSlug('mock');
        $taxon->setCurrentLocale('nl_NL');
        $taxon->setName('Mock');
        $taxon->setCode('mock-code');
        $taxon->setSlug('mock');
        $taxon->setParent($root);

        $this->getEntityManager()->persist($root);
        $this->getEntityManager()->flush();

        $this->generateSitemaps();
    }

    public function testShowActionResponse()
    {
        $response = $this->getBufferedResponse('/sitemap/taxons.xml');

        $this->assertResponse($response, 'show_sitemap_taxons_locale');
    }
}
