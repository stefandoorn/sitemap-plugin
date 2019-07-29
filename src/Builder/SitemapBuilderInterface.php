<?php

declare(strict_types=1);

namespace SitemapPlugin\Builder;

use SitemapPlugin\Model\SitemapInterface;
use SitemapPlugin\Provider\UrlProviderInterface;

interface SitemapBuilderInterface extends BuilderInterface
{
    public function build(array $filter = []): SitemapInterface;

    /**
     * @return UrlProviderInterface[]
     */
    public function getProviders(): iterable;
}
