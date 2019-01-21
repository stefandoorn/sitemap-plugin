<?php

declare(strict_types=1);

namespace SitemapPlugin\Builder;

use SitemapPlugin\Provider\UrlProviderInterface;

interface BuilderInterface
{
    public function addProvider(UrlProviderInterface $provider): void;
}
