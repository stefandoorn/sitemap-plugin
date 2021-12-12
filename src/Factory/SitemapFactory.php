<?php

declare(strict_types=1);

namespace SitemapPlugin\Factory;

use SitemapPlugin\Model\Sitemap;
use SitemapPlugin\Model\SitemapInterface;

final class SitemapFactory implements SitemapFactoryInterface
{
    public function createNew(): SitemapInterface
    {
        return new Sitemap();
    }
}
