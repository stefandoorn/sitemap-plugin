<?php

namespace SyliusSitemapBundle\Builder;

use SyliusSitemapBundle\Factory\SitemapFactoryInterface;
use SyliusSitemapBundle\Provider\UrlProviderInterface;

/**
 * @author Arkadiusz Krakowiak <arkadiusz.krakowiak@lakion.com>
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
     * {@inheritdoc}
     */
    public function build()
    {
        $sitemap = $this->sitemapFactory->createNew();
        $urls = [];

        foreach ($this->providers as $provider) {
            $urls = array_merge($urls, $provider->generate());
        }
        $sitemap->setUrls($urls);

        return $sitemap;
    }
}
