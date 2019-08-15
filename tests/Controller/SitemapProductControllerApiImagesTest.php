<?php

declare(strict_types=1);

namespace Tests\SitemapPlugin\Controller;

use Sylius\Component\Core\Model\Product;
use Sylius\Component\Core\Model\ProductImage;

final class SitemapProductControllerApiImagesTest extends AbstractTestController
{
    use TearDownTrait;

    /**
     * @before
     */
    public function setUpDatabase()
    {
        parent::setUpDatabase();

        $image = new ProductImage();
        $image->setPath('test.jpg');

        $product = new Product();
        $product->setCurrentLocale('en_US');
        $product->setName('Test');
        $product->setCode('test-code');
        $product->setSlug('test');
        $product->addChannel($this->channel);
        $product->addImage($image);
        $this->getEntityManager()->persist($product);

        $image = new ProductImage();
        $image->setPath('mock.jpg');

        $product = new Product();
        $product->setCurrentLocale('en_US');
        $product->setName('Mock');
        $product->setCode('mock-code');
        $product->setSlug('mock');
        $product->addChannel($this->channel);
        $product->addImage($image);
        $this->getEntityManager()->persist($product);

        $this->getEntityManager()->flush();

        $this->generateSitemaps();
    }

    public function testShowActionResponse()
    {
        $response = $this->getResponse('/sitemap/products.xml');

        $this->assertResponse($response, 'show_sitemap_products_image');
    }
}
