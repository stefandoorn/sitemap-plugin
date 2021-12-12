<?php

declare(strict_types=1);

namespace SitemapPlugin\Builder\Factory;

use SitemapPlugin\Builder\Model\AlternativeUrl;
use SitemapPlugin\Builder\Model\AlternativeUrlInterface;

final class AlternativeUrlFactory implements AlternativeUrlFactoryInterface
{
    public function createNew(string $location, string $locale): AlternativeUrlInterface
    {
        return new AlternativeUrl($location, $locale);
    }
}
