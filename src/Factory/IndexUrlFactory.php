<?php

declare(strict_types=1);

namespace SitemapPlugin\Builder\Factory;

use SitemapPlugin\Builder\Model\IndexUrl;
use SitemapPlugin\Builder\Model\IndexUrlInterface;

final class IndexUrlFactory implements IndexUrlFactoryInterface
{
    public function createNew(string $location): IndexUrlInterface
    {
        return new IndexUrl($location);
    }
}
