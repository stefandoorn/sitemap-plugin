<?php

declare(strict_types=1);

namespace SitemapPlugin\Factory;

use SitemapPlugin\Model\SitemapUrl;
use SitemapPlugin\Model\SitemapUrlInterface;

final class SitemapUrlFactory implements SitemapUrlFactoryInterface
{
    /**
     * {@inheritdoc}
     */
    public function createNew(): SitemapUrlInterface
    {
        return new SitemapUrl();
    }
}
