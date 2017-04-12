<?php

namespace Tests\SitemapPlugin\Controller;

use Lakion\ApiTestCase\XmlApiTestCase;
use Sylius\Component\Core\Model\Product;

/**
 * @author Stefan Doorn <stefan@efectos.nl>
 */
class SitemapProductControllerApiTest extends XmlApiTestCase
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

        $product = new Product();
        $product->setCurrentLocale('en_US');
        $product->setName('Mock');
        $product->setCode('mock-code');
        $product->setSlug('mock');
        $this->getEntityManager()->persist($product);

        $this->getEntityManager()->flush();
    }

    public function testShowActionResponse()
    {
        $this->client->request('GET', '/sitemap/products.xml');

        $response = $this->client->getResponse();

        $this->assertResponse($response, 'show_sitemap_products');
    }
}
