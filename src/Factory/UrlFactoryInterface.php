<?php

declare(strict_types=1);

namespace SitemapPlugin\Builder\Factory;

use SitemapPlugin\Builder\Model\UrlInterface;

interface UrlFactoryInterface
{
    public function createNew(string $location): UrlInterface;
}
