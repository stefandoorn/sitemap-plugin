<?php

declare(strict_types=1);

namespace SitemapPlugin\Builder\Factory;

use SitemapPlugin\Builder\Model\ImageInterface;

interface ImageFactoryInterface
{
    public function createNew(string $location): ImageInterface;
}
