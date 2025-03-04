<?php

declare(strict_types=1);

namespace SitemapPlugin\Provider;

use SitemapPlugin\Factory\IndexUrlFactoryInterface;
use Symfony\Component\Routing\RouterInterface;

final class IndexUrlProvider implements IndexUrlProviderInterface
{
    /** @var UrlProviderInterface[] */
    private array $providers = [];

    public function __construct(
        private readonly RouterInterface $router,
        private readonly IndexUrlFactoryInterface $sitemapIndexUrlFactory,
    ) {
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
