<?php

namespace Tests\SitemapPlugin\Controller;

use Lakion\ApiTestCase\XmlApiTestCase;
use Sylius\Component\Core\Model\Product;
use Sylius\Component\Core\Model\Taxon;

/**
 * @author Stefan Doorn <stefan@efectos.nl>
 */
class SitemapAllControllerApiTest extends XmlApiTestCase
{
    /**
     * @before
     */
    public function setUpDatabase()
    {
        parent::setUpDatabase();

        $product = new Product();
        $product->setCurrentLocale('en_US');
        $product->setName('Test');
        $product->setCode('test-code');
        $product->setSlug('test');
        $this->getEntityManager()->persist($product);

        $root = new Taxon();
        $root->setCurrentLocale('en_US');
        $root->setName('Root');
        $root->setCode('root');
        $root->setSlug('root');
        $taxon = new Taxon();
        $taxon->setCurrentLocale('en_US');
        $taxon->setName('Mock');
        $taxon->setCode('mock-code');
        $taxon->setSlug('mock');
        $taxon->setParent($root);
        $this->getEntityManager()->persist($root);

        $this->getEntityManager()->flush();
    }

    public function testShowActionResponse()
    {
        $this->client->request('GET', '/sitemap/all.xml');

        $response = $this->client->getResponse();

        $this->assertResponse($response, 'show_sitemap_all');
    }

    public function testShowActionResponseRelative()
    {
        $this->client->getContainer()->setParameter('sylius.sitemap_absolute_url', false);
        $this->client->request('GET', '/sitemap/all.xml');

        $response = $this->client->getResponse();

        $this->assertResponse($response, 'show_sitemap_all_relative');
    }
}
