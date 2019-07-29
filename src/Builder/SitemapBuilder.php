<?php

declare(strict_types=1);

namespace SitemapPlugin\Builder;

use SitemapPlugin\Factory\SitemapFactoryInterface;
use SitemapPlugin\Model\SitemapInterface;
use SitemapPlugin\Provider\UrlProviderInterface;
use Sylius\Component\Core\Model\ChannelInterface;

final class SitemapBuilder implements SitemapBuilderInterface
{
    /** @var SitemapFactoryInterface */
    private $sitemapFactory;

    /** @var array */
    private $providers = [];

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

    // TODO improve
    public function build(string $providerName, ChannelInterface $channel): SitemapInterface
    {
        $sitemap = $this->sitemapFactory->createNew();
        $urls = [];

        foreach ($this->filter($providerName) as $provider) {
            $urls[] = $provider->generate($channel);
        }

        $sitemap->setUrls(\array_merge(...$urls));

        return $sitemap;
    }

    private function filter(string $providerName): array
    {
        return \array_filter($this->providers, function (UrlProviderInterface $provider) use ($providerName) {
            return $provider->getName() === $providerName;
        });
    }
}
