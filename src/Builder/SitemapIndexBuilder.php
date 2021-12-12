<?php

declare(strict_types=1);

namespace SitemapPlugin\Builder\Builder;

use SitemapPlugin\Builder\Factory\SitemapIndexFactoryInterface;
use SitemapPlugin\Builder\Model\SitemapInterface;
use SitemapPlugin\Builder\Provider\IndexUrlProviderInterface;
use SitemapPlugin\Builder\Provider\UrlProviderInterface;

final class SitemapIndexBuilder implements SitemapIndexBuilderInterface
{
    private SitemapIndexFactoryInterface $sitemapIndexFactory;

    /** @var UrlProviderInterface[] */
    private array $providers = [];

    /** @var IndexUrlProviderInterface[] */
    private array $indexProviders = [];

    public function __construct(SitemapIndexFactoryInterface $sitemapIndexFactory)
    {
        $this->sitemapIndexFactory = $sitemapIndexFactory;
    }

    public function addProvider(UrlProviderInterface $provider): void
    {
        $this->providers[] = $provider;
    }

    public function addIndexProvider(IndexUrlProviderInterface $provider): void
    {
        $this->indexProviders[] = $provider;
    }

    public function build(): SitemapInterface
    {
        $sitemap = $this->sitemapIndexFactory->createNew();
        $urls = [];

        foreach ($this->indexProviders as $indexProvider) {
            foreach ($this->providers as $provider) {
                $indexProvider->addProvider($provider);
            }

            $urls[] = $indexProvider->generate();
        }

        $sitemap->setUrls(\array_merge(...$urls));

        return $sitemap;
    }
}
