<?php

declare(strict_types=1);

namespace StefanDoorn\SyliusSitemapPlugin\Factory;

use StefanDoorn\SyliusSitemapPlugin\Model\SitemapInterface;

interface SitemapFactoryInterface
{
    public function createNew(): SitemapInterface;
}
