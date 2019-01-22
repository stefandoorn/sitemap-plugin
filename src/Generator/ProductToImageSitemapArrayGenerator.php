<?php

declare(strict_types=1);

namespace SitemapPlugin\Generator;

use SitemapPlugin\Factory\SitemapImageUrlFactory;
use Sylius\Component\Core\Model\ProductImageInterface;
use Sylius\Component\Core\Model\ProductInterface;

final class ProductToImageSitemapArrayGenerator
{
    // @todo make not static
    public static function generate(ProductInterface $product): array
    {
        $images = [];

        /** @var ProductImageInterface $image */
        foreach ($product->getImages() as $image) {
            if (!$image->hasFile() || !$image->getPath()) {
                continue;
            }

            // @todo DI
            $sitemapImage = (new SitemapImageUrlFactory())->createNew();
            $sitemapImage->setLocation($image->getPath()); // @todo browser path

            $images[] = $sitemapImage;
        }

        return $images;
    }
}
