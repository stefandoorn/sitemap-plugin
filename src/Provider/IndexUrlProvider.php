<?php

declare(strict_types=1);

namespace SitemapPlugin\Provider;

use SitemapPlugin\Factory\SitemapIndexUrlFactoryInterface;
use Symfony\Component\Routing\RouterInterface;

final class IndexUrlProvider implements IndexUrlProviderInterface
{
    /** @var array */
    private $providers = [];

    /** @var RouterInterface */
    private $router;

    /** @var SitemapIndexUrlFactoryInterface */
    private $sitemapIndexUrlFactory;

    /** @var array */
    private $urls = [];

    public function __construct(
        RouterInterface $router,
        SitemapIndexUrlFactoryInterface $sitemapIndexUrlFactory
    ) {
        $this->router = $router;
        $this->sitemapIndexUrlFactory = $sitemapIndexUrlFactory;
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
    public function generate(): iterable
    {
        foreach ($this->providers as $provider) {
            /** @var UrlProviderInterface $provider */
            $indexUrl = $this->sitemapIndexUrlFactory->createNew();
            $localization = $this->router->generate(
                'sylius_sitemap_' . $provider->getName(),
                [
                    '_format' => 'xml',
                ]
            );

            $indexUrl->setLocalization($localization);

            $this->urls[] = $indexUrl;
        }

        return $this->urls;
    }
}
