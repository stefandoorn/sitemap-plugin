<?php

declare(strict_types=1);

namespace StefanDoorn\SyliusSitemapPlugin\Factory;

use StefanDoorn\SyliusSitemapPlugin\Model\SitemapIndex;
use StefanDoorn\SyliusSitemapPlugin\Model\SitemapInterface;

final class SitemapIndexFactory implements SitemapIndexFactoryInterface
{
    /**
     * @inheritdoc
     */
    public function createNew(): SitemapInterface
    {
        return new SitemapIndex();
    }
}
