<?php

declare(strict_types=1);

namespace SitemapPlugin\Factory;

use SitemapPlugin\Model\AlternativeUrl;
use SitemapPlugin\Model\AlternativeUrlInterface;

final class AlternativeUrlFactory implements AlternativeUrlFactoryInterface
{
    public function createNew(string $location, string $locale): AlternativeUrlInterface
    {
        return new AlternativeUrl($location, $locale);
    }
}
