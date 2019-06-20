<?php

declare(strict_types=1);

namespace SitemapPlugin\Factory;

use SitemapPlugin\Model\UrlAlternative;
use SitemapPlugin\Model\UrlAlternativeInterface;

final class UrlAlternativeFactory implements UrlAlternativeFactoryInterface
{
    public function createNew(string $location, string $locale): UrlAlternativeInterface
    {
        return new UrlAlternative($location, $locale);
    }
}
