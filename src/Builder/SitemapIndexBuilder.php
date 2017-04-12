<?php

namespace SitemapPlugin\Builder;

use SitemapPlugin\Factory\SitemapIndexFactoryInterface;
use SitemapPlugin\Model\SitemapUrl;
use SitemapPlugin\Provider\IndexUrlProviderInterface;
use SitemapPlugin\Provider\UrlProviderInterface;

/**
 * @author Stefan Doorn <stefan@efectos.nl>
 */
final class SitemapIndexBuilder implements SitemapIndexBuilderInterface
{
    /**
     * @var SitemapIndexFactoryInterface
     */
    private $sitemapIndexFactory;

    /**
     * @var array
     */
    private $providers = [];

    /**
     * @var array
     */
    private $indexProviders = [];

    /**
     * @param SitemapIndexFactoryInterface $sitemapFactory
     */
    public function __construct(SitemapIndexFactoryInterface $sitemapIndexFactory)
    {
        $this->sitemapIndexFactory = $sitemapIndexFactory;
    }

    /**
     * {@inheritdoc}
     */
    public function addProvider(UrlProviderInterface $provider)
    {
        $this->providers[] = $provider;
    }

    /**
     * {@inheritdoc}
     */
    public function addIndexProvider(IndexUrlProviderInterface $provider)
    {
        $this->indexProviders[] = $provider;
    }

    /**
     * {@inheritdoc}
     */
    public function build()
    {
        $sitemap = $this->sitemapIndexFactory->createNew();
        $urls = [];

        foreach ($this->indexProviders as $indexProvider) {
            foreach($this->providers as $provider) {
                $indexProvider->addProvider($provider);
            }

            $urls = array_merge($urls, $indexProvider->generate());
        }

        $sitemap->setUrls($urls);

        return $sitemap;
    }
}
