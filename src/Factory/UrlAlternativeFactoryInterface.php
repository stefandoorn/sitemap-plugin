<?php

declare(strict_types=1);

namespace SitemapPlugin\Factory;

use SitemapPlugin\Model\UrlAlternativeInterface;

interface UrlAlternativeFactoryInterface
{
    public function createNew(string $location, string $locale): UrlAlternativeInterface;
}
