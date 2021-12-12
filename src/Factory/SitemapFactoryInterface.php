<?php

declare(strict_types=1);

namespace SitemapPlugin\Factory;

use SitemapPlugin\Model\SitemapInterface;

interface SitemapFactoryInterface
{
    public function createNew(): SitemapInterface;
}
