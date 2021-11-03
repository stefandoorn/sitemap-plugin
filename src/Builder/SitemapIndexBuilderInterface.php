<?php

declare(strict_types=1);

namespace StefanDoorn\SyliusSitemapPlugin\Builder;

use StefanDoorn\SyliusSitemapPlugin\Model\SitemapInterface;
use StefanDoorn\SyliusSitemapPlugin\Provider\IndexUrlProviderInterface;

interface SitemapIndexBuilderInterface extends BuilderInterface
{
    public function addIndexProvider(IndexUrlProviderInterface $provider): void;

    public function build(): SitemapInterface;
}
