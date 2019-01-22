<?php

declare(strict_types=1);

namespace SitemapPlugin\Factory;

use SitemapPlugin\Model\SitemapImageUrlInterface;

interface SitemapImageUrlFactoryInterface
{
    public function createNew(): SitemapImageUrlInterface;
}
