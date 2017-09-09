<?php declare(strict_types=1);

namespace SitemapPlugin\Builder;

use SitemapPlugin\Factory\SitemapIndexFactoryInterface;
use SitemapPlugin\Model\SitemapIndexInterface;
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
     * @param SitemapIndexFactoryInterface $sitemapIndexFactory
     */
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
    public function build(): SitemapIndexInterface
    {
        $sitemap = $this->sitemapIndexFactory->createNew();
        $urls = [];

        foreach ($this->indexProviders as $indexProvider) {
            foreach ($this->providers as $provider) {
                $indexProvider->addProvider($provider);
            }

            $urls = array_merge($urls, $indexProvider->generate());
        }

        $sitemap->setUrls($urls);

        return $sitemap;
    }
}
