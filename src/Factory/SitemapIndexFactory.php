<?php

declare(strict_types=1);

namespace SitemapPlugin\Factory;

use SitemapPlugin\Model\SitemapIndex;
use SitemapPlugin\Model\SitemapInterface;

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
