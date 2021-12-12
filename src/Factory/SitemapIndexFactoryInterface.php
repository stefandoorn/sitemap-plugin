<?php

declare(strict_types=1);

namespace SitemapPlugin\Builder\Factory;

use SitemapPlugin\Builder\Model\SitemapInterface;

interface SitemapIndexFactoryInterface
{
    public function createNew(): SitemapInterface;
}
