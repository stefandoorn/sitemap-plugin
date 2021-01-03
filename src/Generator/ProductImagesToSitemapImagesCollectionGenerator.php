<?php

declare(strict_types=1);

namespace SitemapPlugin\Generator;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Liip\ImagineBundle\Imagine\Cache\CacheManager;
use SitemapPlugin\Factory\ImageFactoryInterface;
use Sylius\Component\Core\Model\ProductImageInterface;
use Sylius\Component\Core\Model\ProductInterface;

final class ProductImagesToSitemapImagesCollectionGenerator implements ProductImagesToSitemapImagesCollectionGeneratorInterface
{
    /** @var CacheManager */
    private $imagineCacheManager;

    /** @var ImageFactoryInterface */
    private $sitemapImageUrlFactory;

    /** @var string */
    private $imagePreset;

    /** @var string */
    private $imageCacheResolver;

    public function __construct(
        ImageFactoryInterface $sitemapImageUrlFactory,
        CacheManager $imagineCacheManager,
        string $imagePreset = 'sylius_shop_product_original',
        string $imageCacheResolver = null
    ) {
        $this->sitemapImageUrlFactory = $sitemapImageUrlFactory;
        $this->imagineCacheManager = $imagineCacheManager;
        $this->imagePreset = $imagePreset;
    }

    public function generate(ProductInterface $product): Collection
    {
        $images = new ArrayCollection();

        /** @var ProductImageInterface $image */
        foreach ($product->getImages() as $image) {
            /** @var string $path */
            $path = $image->getPath();

            if (!$path) {
                continue;
            }

            $sitemapImage = $this->sitemapImageUrlFactory->createNew($this->imagineCacheManager->getBrowserPath($path, $this->imagePreset, [], $this->imageCacheResolver));

            $images->add($sitemapImage);
        }

        return $images;
    }
}
