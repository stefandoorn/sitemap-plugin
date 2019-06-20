<?php

declare(strict_types=1);

namespace SitemapPlugin\Factory;

use SitemapPlugin\Model\UrlInterface;

interface UrlFactoryInterface
{
    public function createNew(string $location): UrlInterface;
}
