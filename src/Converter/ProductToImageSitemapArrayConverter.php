<?php

declare(strict_types=1);

namespace SitemapPlugin\Converter;

use SitemapPlugin\Factory\SitemapImageUrlFactory;
use Sylius\Component\Core\Model\ProductImageInterface;
use Sylius\Component\Core\Model\ProductInterface;

final class ProductToImageSitemapArrayConverter
{
    // @todo make not static
    public static function generate(ProductInterface $product): array
    {
        $images = [];

        /** @var ProductImageInterface $image */
        foreach($product->getImages() as $image) {
            // @todo DI
            $sitemapImage = (new SitemapImageUrlFactory())->createNew();
            $sitemapImage->setLocation($image->getPath()); // @todo browser path

            $images[] = $sitemapImage;
        }

        return $images;
    }
}