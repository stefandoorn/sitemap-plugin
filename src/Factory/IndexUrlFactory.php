<?php

declare(strict_types=1);

namespace StefanDoorn\SyliusSitemapPlugin\Factory;

use StefanDoorn\SyliusSitemapPlugin\Model\IndexUrl;
use StefanDoorn\SyliusSitemapPlugin\Model\IndexUrlInterface;

final class IndexUrlFactory implements IndexUrlFactoryInterface
{
    public function createNew(string $location): IndexUrlInterface
    {
        return new IndexUrl($location);
    }
}
