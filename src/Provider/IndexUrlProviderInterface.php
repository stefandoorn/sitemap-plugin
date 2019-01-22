<?php

declare(strict_types=1);

namespace SitemapPlugin\Provider;

interface IndexUrlProviderInterface
{
    /**
     * @return array
     */
    public function generate(): iterable;

    public function addProvider(UrlProviderInterface $provider): void;
}
