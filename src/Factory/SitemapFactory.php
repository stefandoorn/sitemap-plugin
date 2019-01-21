<?php

declare(strict_types=1);

namespace SitemapPlugin\Factory;

use SitemapPlugin\Model\Sitemap;
use SitemapPlugin\Model\SitemapInterface;

final class SitemapFactory implements SitemapFactoryInterface
{
    /**
     * {@inheritdoc}
     */
    public function createNew(): SitemapInterface
    {
        return new Sitemap();
    }
}
