<?php

declare(strict_types=1);

namespace StefanDoorn\SyliusSitemapPlugin\Provider;

interface IndexUrlProviderInterface
{
    public function generate(): array;

    public function addProvider(UrlProviderInterface $provider): void;
}
