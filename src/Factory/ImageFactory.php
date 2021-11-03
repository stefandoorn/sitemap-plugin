<?php

declare(strict_types=1);

namespace StefanDoorn\SyliusSitemapPlugin\Factory;

use StefanDoorn\SyliusSitemapPlugin\Model\Image;
use StefanDoorn\SyliusSitemapPlugin\Model\ImageInterface;

final class ImageFactory implements ImageFactoryInterface
{
    public function createNew(string $location): ImageInterface
    {
        return new Image($location);
    }
}
