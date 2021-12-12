<?php

declare(strict_types=1);

namespace SitemapPlugin\Builder\Builder;

use SitemapPlugin\Builder\Provider\UrlProviderInterface;

interface BuilderInterface
{
    public function addProvider(UrlProviderInterface $provider): void;
}
