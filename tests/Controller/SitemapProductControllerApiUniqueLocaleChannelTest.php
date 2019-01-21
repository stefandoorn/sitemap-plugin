<?php

declare(strict_types=1);

namespace Tests\SitemapPlugin\Controller;

use Sylius\Component\Core\Model\Product;

class SitemapProductControllerApiUniqueLocaleChannelTest extends AbstractTestController
{
    use TearDownTrait;

    /**
     * @before
     */
    public function setupDatabase()
    {
        parent::setupDatabase();

        $this->channel->removeLocale($this->locale2);

        $product = new Product();
        $product->setCurrentLocale('en_US');
        $product->setName('Test');
        $product->setCode('test-code');
        $product->setSlug('test');
        $product->setCurrentLocale('nl_NL');
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
        $product->setCurrentLocale('nl_NL');
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
        $product->setCurrentLocale('nl_NL');
        $product->setName('Test 2');
        $product->setCode('test-code-3');
        $product->setSlug('test 2');
        $product->setEnabled(false);
        $product->addChannel($this->channel);
        $this->getEntityManager()->persist($product);

        $product = new Product();
        $product->setCurrentLocale('en_US');
        $product->setName('Test 3');
        $product->setCode('test-code-4');
        $product->setSlug('test 3');
        $product->setCurrentLocale('nl_NL');
        $product->setName('Test 3');
        $product->setCode('test-code-4');
        $product->setSlug('test 3');
        $product->setEnabled(false);
        $this->getEntityManager()->persist($product);

        $this->getEntityManager()->flush();
    }

    public function testShowActionResponse()
    {
        $this->client->request('GET', '/sitemap/products.xml');

        $response = $this->client->getResponse();

        $this->assertResponse($response, 'show_sitemap_products_unique_channel_locale');
    }
}
