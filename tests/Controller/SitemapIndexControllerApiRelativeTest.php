<?php

declare(strict_types=1);

namespace Tests\SitemapPlugin\Controller;

use Sylius\Component\Core\Model\Product;
use Sylius\Component\Core\Model\Taxon;

final class SitemapIndexControllerApiRelativeTest extends AbstractTestController
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
        $this->getEntityManager()->persist($product);

        $taxon = new Taxon();
        $taxon->setCurrentLocale('en_US');
        $taxon->setName('Mock');
        $taxon->setCode('mock-code');
        $taxon->setSlug('mock');
        $this->getEntityManager()->persist($taxon);

        $this->getEntityManager()->flush();
    }

    public function testShowActionResponseRelative()
    {
        $this->client->request('GET', '/sitemap_index.xml');

        $response = $this->client->getResponse();

        $this->assertResponse($response, 'show_sitemap_index_relative');
    }
}
