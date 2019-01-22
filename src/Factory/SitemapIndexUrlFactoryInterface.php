<?php

declare(strict_types=1);

namespace SitemapPlugin\Factory;

use SitemapPlugin\Model\SitemapIndexUrlInterface;

interface SitemapIndexUrlFactoryInterface
{
    public function createNew(): SitemapIndexUrlInterface;
}
