<?php

declare(strict_types=1);

namespace SitemapPlugin\Factory;

use SitemapPlugin\Model\SitemapInterface;

interface SitemapIndexFactoryInterface
{
    public function createNew(): SitemapInterface;
}
