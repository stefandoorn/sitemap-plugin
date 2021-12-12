<?php

declare(strict_types=1);

namespace SitemapPlugin\Builder\Builder;

use SitemapPlugin\Builder\Model\SitemapInterface;
use SitemapPlugin\Builder\Provider\IndexUrlProviderInterface;

interface SitemapIndexBuilderInterface extends BuilderInterface
{
    public function addIndexProvider(IndexUrlProviderInterface $provider): void;

    public function build(): SitemapInterface;
}
