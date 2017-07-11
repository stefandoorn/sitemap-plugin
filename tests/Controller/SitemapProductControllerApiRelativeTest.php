<?php

namespace Tests\SitemapPlugin\Controller;

use Sylius\Component\Core\Model\Product;

/**
 * @author Stefan Doorn <stefan@efectos.nl>
 */
class SitemapProductControllerApiRelativeTest extends AbstractTestController
{
    use RelativeClientTrait;
    use TearDownTrait;

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
        $product->addChannel($this->channel);
        $this->getEntityManager()->persist($product);

        $product = new Product();
        $product->setCurrentLocale('en_US');
        $product->setName('Mock');
        $product->setCode('mock-code');
        $product->setSlug('mock');
        $product->addChannel($this->channel);
        $this->getEntityManager()->persist($product);

        $product = new Product();
        $product->setCurrentLocale('en_US');
        $product->setName('Test 2');
        $product->setCode('test-code-3');
        $product->setSlug('test 2');
        $product->setEnabled(false);
        $product->addChannel($this->channel);
        $this->getEntityManager()->persist($product);

        $this->getEntityManager()->flush();
    }

    public function testShowActionResponseRelative()
    {
        $this->client->request('GET', '/sitemap/products.xml');

        $response = $this->client->getResponse();

        $this->assertResponse($response, 'show_sitemap_products_relative');
    }
}
