<?php

declare(strict_types=1);

namespace SitemapPlugin\Factory;

use SitemapPlugin\Model\ImageInterface;

interface ImageFactoryInterface
{
    public function createNew(string $location): ImageInterface;
}
