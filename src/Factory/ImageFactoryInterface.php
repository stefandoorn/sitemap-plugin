<?php

declare(strict_types=1);

namespace StefanDoorn\SyliusSitemapPlugin\Factory;

use StefanDoorn\SyliusSitemapPlugin\Model\ImageInterface;

interface ImageFactoryInterface
{
    public function createNew(string $location): ImageInterface;
}
