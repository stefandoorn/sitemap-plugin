<?php

declare(strict_types=1);

namespace SitemapPlugin\Factory;

use SitemapPlugin\Model\Url;
use SitemapPlugin\Model\UrlInterface;

final class UrlFactory implements UrlFactoryInterface
{
    public function createNew(string $location): UrlInterface
    {
        return new Url($location);
    }
}
