<?php

declare(strict_types=1);

namespace SitemapPlugin\Builder;

use SitemapPlugin\Model\SitemapInterface;
use SitemapPlugin\Provider\IndexUrlProviderInterface;
use SitemapPlugin\Provider\UrlProviderInterface;

interface SitemapIndexBuilderInterface extends BuilderInterface
{
    public function addIndexProvider(IndexUrlProviderInterface $indexProvider): void;

    public function addPath(UrlProviderInterface $provider, string $path): void;

    public function build(): SitemapInterface;
}
