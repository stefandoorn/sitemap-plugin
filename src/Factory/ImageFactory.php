<?php

declare(strict_types=1);

namespace SitemapPlugin\Builder\Factory;

use SitemapPlugin\Builder\Model\Image;
use SitemapPlugin\Builder\Model\ImageInterface;

final class ImageFactory implements ImageFactoryInterface
{
    public function createNew(string $location): ImageInterface
    {
        return new Image($location);
    }
}
