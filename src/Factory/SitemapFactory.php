<?php

declare(strict_types=1);

namespace SitemapPlugin\Builder\Factory;

use SitemapPlugin\Builder\Model\Sitemap;
use SitemapPlugin\Builder\Model\SitemapInterface;

final class SitemapFactory implements SitemapFactoryInterface
{
    /**
     * @inheritdoc
     */
    public function createNew(): SitemapInterface
    {
        return new Sitemap();
    }
}
