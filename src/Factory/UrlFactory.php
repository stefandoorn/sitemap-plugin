<?php

declare(strict_types=1);

namespace StefanDoorn\SyliusSitemapPlugin\Factory;

use StefanDoorn\SyliusSitemapPlugin\Model\Url;
use StefanDoorn\SyliusSitemapPlugin\Model\UrlInterface;

final class UrlFactory implements UrlFactoryInterface
{
    public function createNew(string $location): UrlInterface
    {
        return new Url($location);
    }
}
