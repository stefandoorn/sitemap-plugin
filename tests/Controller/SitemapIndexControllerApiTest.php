<?php

declare(strict_types=1);

namespace Tests\SitemapPlugin\Controller;

use Sylius\Component\Core\Model\Product;
use Sylius\Component\Core\Model\Taxon;

final class SitemapIndexControllerApiTest extends AbstractTestController
{
    use TearDownTrait;

    /**
     * @before
     */
    public function setUpDatabase(): void
    {
        var_dump('start setup database');

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
        var_dump('saving data');
        $this->getEntityManager()->flush();

        var_dump('generate sitemap');
        $this->generateSitemaps();
    }

    public function testShowActionResponse()
    {
        $response = $this->getBufferedResponse('/sitemap_index.xml');

        $this->assertResponse($response, 'show_sitemap_index');
    }

    public function testRedirectResponse()
    {
        $response = $this->getBufferedResponse('/sitemap.xml');

        $this->assertResponseCode($response, 301);
        $this->assertTrue($response->isRedirect());

        $location = $response->headers->get('Location');
        $this->assertStringContainsString('sitemap_index.xml', $location);
    }
}
