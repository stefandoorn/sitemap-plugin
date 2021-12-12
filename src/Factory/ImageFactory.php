<?php

declare(strict_types=1);

namespace SitemapPlugin\Factory;

use SitemapPlugin\Model\Image;
use SitemapPlugin\Model\ImageInterface;

final class ImageFactory implements ImageFactoryInterface
{
    public function createNew(string $location): ImageInterface
    {
        return new Image($location);
    }
}
