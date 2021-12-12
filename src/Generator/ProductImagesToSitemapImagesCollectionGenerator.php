<?php

declare(strict_types=1);

namespace SitemapPlugin\Builder\Generator;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Liip\ImagineBundle\Imagine\Cache\CacheManager;
use SitemapPlugin\Builder\Factory\ImageFactoryInterface;
use Sylius\Component\Core\Model\ProductImageInterface;
use Sylius\Component\Core\Model\ProductInterface;

final class ProductImagesToSitemapImagesCollectionGenerator implements ProductImagesToSitemapImagesCollectionGeneratorInterface
{
    private CacheManager $imagineCacheManager;

    private ImageFactoryInterface $sitemapImageUrlFactory;

    private string $imagePreset = 'sylius_shop_product_original';

    public function __construct(
        ImageFactoryInterface $sitemapImageUrlFactory,
        CacheManager $imagineCacheManager,
        ?string $imagePreset = null
    ) {
        $this->sitemapImageUrlFactory = $sitemapImageUrlFactory;
        $this->imagineCacheManager = $imagineCacheManager;

        if (null !== $imagePreset) {
            $this->imagePreset = $imagePreset;
        }
    }

    public function generate(ProductInterface $product): Collection
    {
        $images = new ArrayCollection();

        /** @var ProductImageInterface $image */
        foreach ($product->getImages() as $image) {
            $path = $image->getPath();

            if (null === $path) {
                continue;
            }

            $sitemapImage = $this->sitemapImageUrlFactory->createNew($this->imagineCacheManager->getBrowserPath($path, $this->imagePreset));

            /**
             * @psalm-suppress InvalidArgument
             */
            $images->add($sitemapImage);
        }

        return $images;
    }
}
