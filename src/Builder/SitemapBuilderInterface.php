<?php

declare(strict_types=1);

namespace SitemapPlugin\Builder;

use SitemapPlugin\Model\SitemapInterface;

interface SitemapBuilderInterface extends BuilderInterface
{
    public function build(array $filter = []): SitemapInterface;

    /**
     * @return array
     */
    public function getProviders(): iterable;
}
