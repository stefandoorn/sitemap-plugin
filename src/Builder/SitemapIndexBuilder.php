<?php

declare(strict_types=1);

namespace SitemapPlugin\Builder;

use SitemapPlugin\Factory\SitemapIndexFactoryInterface;
use SitemapPlugin\Model\SitemapInterface;
use SitemapPlugin\Provider\IndexUrlProviderInterface;
use SitemapPlugin\Provider\UrlProviderInterface;

final class SitemapIndexBuilder implements SitemapIndexBuilderInterface
{
    /** @var SitemapIndexFactoryInterface */
    private $sitemapIndexFactory;

    /** @var array */
    private $providers = [];

    /** @var array */
    private $indexProviders = [];

    /** @var array */
    private $paths = [];

    public function __construct(SitemapIndexFactoryInterface $sitemapIndexFactory)
    {
        $this->sitemapIndexFactory = $sitemapIndexFactory;
    }

    /**
     * {@inheritdoc}
     */
    public function addProvider(UrlProviderInterface $provider): void
    {
        $this->providers[] = $provider;
    }

    /**
     * {@inheritdoc}
     */
    public function addIndexProvider(IndexUrlProviderInterface $provider): void
    {
        $this->indexProviders[] = $provider;
    }

    /**
     * {@inheritdoc}
     */
    public function addPath(UrlProviderInterface $provider, string $path): void
    {
        if (!array_key_exists($provider->getName(), $this->paths)) {
            $this->paths[$provider->getName()] = [];
        }

        $this->paths[$provider->getName()][] = $path;
    }

    /**
     * {@inheritdoc}
     */
    public function build(): SitemapInterface
    {
        $sitemap = $this->sitemapIndexFactory->createNew();
        $urls = [];

        /** @var IndexUrlProviderInterface $indexProvider */
        foreach ($this->indexProviders as $indexProvider) {
            /** @var UrlProviderInterface $provider */
            foreach ($this->providers as $provider) {
                if(array_key_exists($provider->getName(), $this->paths)) {
                    $indexProvider->addProvider($provider, $this->paths[$provider->getName()]);
                }            }

            $urls[] = $indexProvider->generate();
        }

        $sitemap->setUrls(\array_merge(...$urls));

        return $sitemap;
    }
}
