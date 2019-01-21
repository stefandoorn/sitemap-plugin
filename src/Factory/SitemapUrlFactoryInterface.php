<?php

declare(strict_types=1);

namespace SitemapPlugin\Factory;

use SitemapPlugin\Model\SitemapUrlInterface;

interface SitemapUrlFactoryInterface
{
    public function createNew(): SitemapUrlInterface;
}
