<?php

namespace SitemapPlugin\Builder;

use SitemapPlugin\Factory\SitemapFactoryInterface;
use SitemapPlugin\Provider\UrlProviderInterface;

/**
 * @author Arkadiusz Krakowiak <arkadiusz.krakowiak@lakion.com>
 * @author Stefan Doorn <stefan@efectos.nl>
 */
final class SitemapBuilder implements SitemapBuilderInterface
{
    /**
     * @var SitemapFactoryInterface
     */
    private $sitemapFactory;

    /**
     * @var array
     */
    private $providers = [];

    /**
     * @param SitemapFactoryInterface $sitemapFactory
     */
    public function __construct(SitemapFactoryInterface $sitemapFactory)
    {
        $this->sitemapFactory = $sitemapFactory;
    }

    /**
     * {@inheritdoc}
     */
    public function addProvider(UrlProviderInterface $provider)
    {
        $this->providers[] = $provider;
    }

    /**
     * @return array
     */
    public function getProviders()
    {
        return $this->providers;
    }

    /**
     * {@inheritdoc}
     */
    public function build(array $filter = [])
    {
        $sitemap = $this->sitemapFactory->createNew();
        $urls = [];

        foreach ($this->filter($filter) as $provider) {
            $urls = array_merge($urls, $provider->generate());
        }

        $sitemap->setUrls($urls);

        return $sitemap;
    }

    /**
     * @param array $filter
     * @return array
     */
    private function filter(array $filter) {
        if (empty($filter)) {
            return $this->providers;
        }

        return array_filter($this->providers, function(UrlProviderInterface $provider) use ($filter) {
            return in_array($provider->getName(), $filter);
        });
    }
}
