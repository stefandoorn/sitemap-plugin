<?php

declare(strict_types=1);

namespace SitemapPlugin\Builder\Factory;

use SitemapPlugin\Builder\Model\Url;
use SitemapPlugin\Builder\Model\UrlInterface;

final class UrlFactory implements UrlFactoryInterface
{
    public function createNew(string $location): UrlInterface
    {
        return new Url($location);
    }
}
