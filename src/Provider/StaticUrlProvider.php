<?php

declare(strict_types=1);

namespace SitemapPlugin\Provider;

use SitemapPlugin\Factory\AlternativeUrlFactoryInterface;
use SitemapPlugin\Factory\UrlFactoryInterface;
use SitemapPlugin\Model\ChangeFrequency;
use Sylius\Component\Core\Model\ChannelInterface;
use Symfony\Component\Routing\RouterInterface;

final class StaticUrlProvider implements UrlProviderInterface
{
    private ChannelInterface $channel;

    public function __construct(
        private readonly RouterInterface $router,
        private readonly UrlFactoryInterface $sitemapUrlFactory,
        private readonly AlternativeUrlFactoryInterface $urlAlternativeFactory,
        /** @var array<string, array> */
        private readonly array $routes,
    ) {
    }

    public function getName(): string
    {
        return 'static';
    }

    public function generate(ChannelInterface $channel): iterable
    {
        $this->channel = $channel;
        $urls = [];

        if (0 === \count($this->routes)) {
            return $urls;
        }

        foreach ($this->transformAndYieldRoutes() as $route) {
            $location = $this->router->generate($route['route'], $route['parameters']);

            $staticUrl = $this->sitemapUrlFactory->createNew($location);
            $staticUrl->setChangeFrequency(ChangeFrequency::weekly());
            $staticUrl->setPriority($route['priority']);

            foreach ($route['locales'] as $alternativeLocaleCode) {
                $route['parameters']['_locale'] = $alternativeLocaleCode;
                $alternativeLocation = $this->router->generate($route['route'], $route['parameters']);
                $staticUrl->addAlternative($this->urlAlternativeFactory->createNew($alternativeLocation, $alternativeLocaleCode));
            }

            $urls[] = $staticUrl;
        }

        return $urls;
    }

    private function transformAndYieldRoutes(): \Generator
    {
        foreach ($this->routes as $route) {
            yield $this->transformRoute($route);
        }
    }

    private function transformRoute(array $route): array
    {
        // Add default locale to route if not set
        $route = $this->addDefaultRoute($route);

        // Populate locales array by other enabled locales for current channel if no locales are specified
        if (!isset($route['locales']) || 0 === \count($route['locales'])) {
            $route['locales'] = $this->getAlternativeLocales();
        }

        // Remove the locale that is on the main route from the alternatives to prevent duplicates
        $route = $this->excludeMainRouteLocaleFromAlternativeLocales($route);

        return $route;
    }

    private function addDefaultRoute(array $route): array
    {
        if (isset($route['parameters']['_locale'])) {
            return $route;
        }

        $defaultLocale = $this->channel->getDefaultLocale();

        if (null !== $defaultLocale) {
            $route['parameters']['_locale'] = $defaultLocale->getCode();
        }

        return $route;
    }

    private function excludeMainRouteLocaleFromAlternativeLocales(array $route): array
    {
        $locales = $route['locales'];
        $locale = $route['parameters']['_locale'];

        $key = \array_search($locale, $locales, true);

        if ($key !== false) {
            unset($route['locales'][$key]);
        }

        return $route;
    }

    /**
     * @return array<int, string|null>
     */
    private function getAlternativeLocales(): array
    {
        $locales = [];

        foreach ($this->channel->getLocales() as $locale) {
            if ($locale === $this->channel->getDefaultLocale()) {
                continue;
            }

            $locales[] = $locale->getCode();
        }

        return $locales;
    }
}
