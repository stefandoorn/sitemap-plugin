<?php

declare(strict_types=1);

namespace SitemapPlugin\Provider;

use SitemapPlugin\Factory\IndexUrlFactoryInterface;
use Symfony\Component\Routing\RouterInterface;
use Sylius\Component\Core\Model\ChannelInterface;

final class IndexUrlProvider implements IndexUrlProviderInterface
{
    /** @var UrlProviderInterface[] */
    private array $providers = [];

    private RouterInterface $router;

    private IndexUrlFactoryInterface $sitemapIndexUrlFactory;

    public function __construct(
        RouterInterface $router,
        IndexUrlFactoryInterface $sitemapIndexUrlFactory
    ) {
        $this->router = $router;
        $this->sitemapIndexUrlFactory = $sitemapIndexUrlFactory;
    }

    public function addProvider(UrlProviderInterface $provider): void
    {
        $this->providers[] = $provider;
    }

    public function generate(ChannelInterface $channel): iterable
    {
        $urls = [];
        $locale= $channel->getDefaultLocale()->getCode();
        foreach ($this->providers as $provider) {
            $location = $this->router->generate('sylius_sitemap_' . $provider->getName(),[ '_locale' => $locale,
            'countryCode'=>$this->getCountryCodeByLocale($locale)]);
            $urls[] = $this->sitemapIndexUrlFactory->createNew($location);
        }

        return $urls;
    }
    public function getCountryCodeByLocale(string $locale): string {
       return $locale == 'en_US'?'us': explode("_",$locale)[0];
    }
}
