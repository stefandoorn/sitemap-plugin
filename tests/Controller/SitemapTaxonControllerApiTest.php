<?php

namespace Tests\SitemapPlugin\Controller;

use Lakion\ApiTestCase\XmlApiTestCase;
use Sylius\Component\Core\Model\Product;
use Sylius\Component\Core\Model\Taxon;

/**
 * @author Stefan Doorn <stefan@efectos.nl>
 */
class SitemapTaxonControllerApiTest extends XmlApiTestCase
{
    /**
     * @before
     */
    public function setUpDatabase()
    {
        parent::setUpDatabase();

        $root = new Taxon();
        $root->setCurrentLocale('en_US');
        $root->setName('Root');
        $root->setCode('root');
        $root->setSlug('root');

        $taxon = new Taxon();
        $taxon->setCurrentLocale('en_US');
        $taxon->setName('Test');
        $taxon->setCode('test-code');
        $taxon->setSlug('test');
        $taxon->setParent($root);
        $this->getEntityManager()->persist($taxon);

        $taxon = new Taxon();
        $taxon->setCurrentLocale('en_US');
        $taxon->setName('Mock');
        $taxon->setCode('mock-code');
        $taxon->setSlug('mock');
        $taxon->setParent($root);
        $this->getEntityManager()->persist($taxon);

        $this->getEntityManager()->persist($root);

        $this->getEntityManager()->flush();
    }

    public function testShowActionResponse()
    {
        $this->client->request('GET', '/sitemap/taxons.xml');

        $response = $this->client->getResponse();

        $this->assertResponse($response, 'show_sitemap_taxons');
    }
}
