<?php

declare(strict_types=1);

namespace StefanDoorn\SyliusSitemapPlugin\Factory;

use StefanDoorn\SyliusSitemapPlugin\Model\Sitemap;
use StefanDoorn\SyliusSitemapPlugin\Model\SitemapInterface;

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
