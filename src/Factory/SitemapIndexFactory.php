<?php

declare(strict_types=1);

namespace SitemapPlugin\Builder\Factory;

use SitemapPlugin\Builder\Model\SitemapIndex;
use SitemapPlugin\Builder\Model\SitemapInterface;

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
