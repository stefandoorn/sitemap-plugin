<?php

declare(strict_types=1);

namespace SitemapPlugin\Provider;

use SitemapPlugin\Factory\IndexUrlFactoryInterface;
use Symfony\Component\Routing\RouterInterface;

final class IndexUrlProvider implements IndexUrlProviderInterface
{
    /** @var UrlProviderInterface[] */
    private array $providers = [];

    /** @var array */
    private array $paths = [];

    public function __construct(
        private readonly RouterInterface $router,
        private readonly IndexUrlFactoryInterface $sitemapIndexUrlFactory,
    ) {
    }

    public function addProvider(UrlProviderInterface $provider): void
    {
        $this->providers[] = $provider;
    }

    public function addPaths(array $paths): void
    {
        $this->paths = $paths;
    }

    public function generate(): iterable
    {
        $urls = [];
        foreach ($this->providers as $provider) {
            $pathCount = count($this->paths[$provider->getName()]);
            for ($i = 0; $i < $pathCount; $i++) {
                $params = ['index' => $i];
                $location = $this->router->generate('sylius_sitemap_'.$provider->getName(), $params);
                $urls[] = $this->sitemapIndexUrlFactory->createNew($location);
            }
        }

        return $urls;
    }
}
