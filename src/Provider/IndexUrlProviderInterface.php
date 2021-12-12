<?php

declare(strict_types=1);

namespace SitemapPlugin\Provider;

interface IndexUrlProviderInterface
{
    public function generate(): array;

    public function addProvider(UrlProviderInterface $provider): void;
}
