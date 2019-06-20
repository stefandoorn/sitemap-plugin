<?php

declare(strict_types=1);

namespace SitemapPlugin\Factory;

use SitemapPlugin\Model\IndexUrl;
use SitemapPlugin\Model\IndexUrlInterface;

final class IndexUrlFactory implements IndexUrlFactoryInterface
{
    public function createNew(string $location): IndexUrlInterface
    {
        return new IndexUrl($location);
    }
}
