<?php

declare(strict_types=1);

namespace SitemapPlugin\Generator;

use Liip\ImagineBundle\Imagine\Cache\CacheManager;
use SitemapPlugin\Factory\SitemapImageUrlFactoryInterface;
use Sylius\Component\Core\Model\ProductImageInterface;
use Sylius\Component\Core\Model\ProductInterface;

final class ProductToImageSitemapArrayGenerator implements ProductToImageSitemapArrayGeneratorInterface
{
    /** @var CacheManager */
    private $imagineCacheManager;

    /** @var SitemapImageUrlFactoryInterface */
    private $sitemapImageUrlFactory;

    /** @var string */
    private $imagePreset;

    public function __construct(
        SitemapImageUrlFactoryInterface $sitemapImageUrlFactory,
        CacheManager $imagineCacheManager,
        string $imagePreset = 'sylius_shop_product_original'
    ) {
        $this->sitemapImageUrlFactory = $sitemapImageUrlFactory;
        $this->imagineCacheManager = $imagineCacheManager;
        $this->imagePreset = $imagePreset;
    }

    public function generate(ProductInterface $product): array
    {
        $images = [];

        /** @var ProductImageInterface $image */
        foreach ($product->getImages() as $image) {
            if (!$image->getPath()) {
                continue;
            }

            $sitemapImage = $this->sitemapImageUrlFactory->createNew();
            $sitemapImage->setLocation($this->imagineCacheManager->getBrowserPath($image->getPath(),
                $this->imagePreset));

            $images[] = $sitemapImage;
        }

        return $images;
    }
}
