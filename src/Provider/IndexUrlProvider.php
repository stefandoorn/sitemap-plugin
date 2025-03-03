<?php

declare(strict_types=1);

namespace SitemapPlugin\Provider;

use SitemapPlugin\Factory\IndexUrlFactoryInterface;
use Symfony\Component\Routing\RouterInterface;

final class IndexUrlProvider implements IndexUrlProviderInterface
{
    /** @var UrlProviderInterface[] */
    private array $providers = [];

    private RouterInterface $router;

    private IndexUrlFactoryInterface $sitemapIndexUrlFactory;

    public function __construct(
        RouterInterface $router,
        IndexUrlFactoryInterface $sitemapIndexUrlFactory,
    ) {
        $this->router = $router;
        $this->sitemapIndexUrlFactory = $sitemapIndexUrlFactory;
    }

    public function addProvider(UrlProviderInterface $provider): void
    {
        $this->providers[] = $provider;
    }

    public function generate(): iterable
    {
        $urls = [];
        foreach ($this->providers as $provider) {
            $location = $this->router->generate('sylius_sitemap_' . $provider->getName());
            $urls[] = $this->sitemapIndexUrlFactory->createNew($location);
        }

        return $urls;
    }
}
