<?php

declare(strict_types=1);

namespace StefanDoorn\SyliusSitemapPlugin\Builder;

use StefanDoorn\SyliusSitemapPlugin\Provider\UrlProviderInterface;

interface BuilderInterface
{
    public function addProvider(UrlProviderInterface $provider): void;
}
