<?php

declare(strict_types=1);

namespace StefanDoorn\SyliusSitemapPlugin\Builder;

use StefanDoorn\SyliusSitemapPlugin\Factory\SitemapFactoryInterface;
use StefanDoorn\SyliusSitemapPlugin\Model\SitemapInterface;
use StefanDoorn\SyliusSitemapPlugin\Provider\UrlProviderInterface;
use Sylius\Component\Core\Model\ChannelInterface;

final class SitemapBuilder implements SitemapBuilderInterface
{
    private SitemapFactoryInterface $sitemapFactory;

    /** @var UrlProviderInterface[] */
    private array $providers = [];

    public function __construct(SitemapFactoryInterface $sitemapFactory)
    {
        $this->sitemapFactory = $sitemapFactory;
    }

    public function addProvider(UrlProviderInterface $provider): void
    {
        $this->providers[] = $provider;
    }

    public function getProviders(): iterable
    {
        return $this->providers;
    }

    public function build(UrlProviderInterface $provider, ChannelInterface $channel): SitemapInterface
    {
        $urls = [];

        $sitemap = $this->sitemapFactory->createNew();
        $urls[] = $provider->generate($channel);

        $sitemap->setUrls(\array_merge(...$urls));

        return $sitemap;
    }
}
