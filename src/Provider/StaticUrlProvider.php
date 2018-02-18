<?php declare(strict_types=1);

namespace SitemapPlugin\Provider;

use SitemapPlugin\Factory\SitemapUrlFactoryInterface;
use SitemapPlugin\Model\ChangeFrequency;
use Sylius\Component\Channel\Context\ChannelContextInterface;
use Sylius\Component\Core\Model\ChannelInterface;
use Symfony\Component\Routing\RouterInterface;

/**
 * @author Stefan Doorn <stefan@efectos.nl>
 */
final class StaticUrlProvider implements UrlProviderInterface
{
    /**
     * @var RouterInterface
     */
    private $router;

    /**
     * @var SitemapUrlFactoryInterface
     */
    private $sitemapUrlFactory;

    /**
     * @var array
     */
    private $urls = [];

    /**
     * @var array
     */
    private $routes;

    /**
     * @var ChannelContextInterface
     */
    private $channelContext;

    /**
     * StaticUrlProvider constructor.
     * @param RouterInterface $router
     * @param SitemapUrlFactoryInterface $sitemapUrlFactory
     * @param ChannelContextInterface $channelContext
     * @param array $routes
     */
    public function __construct(
        RouterInterface $router,
        SitemapUrlFactoryInterface $sitemapUrlFactory,
        ChannelContextInterface $channelContext,
        array $routes
    ) {
        $this->router = $router;
        $this->sitemapUrlFactory = $sitemapUrlFactory;
        $this->channelContext = $channelContext;
        $this->routes = $routes;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return 'static';
    }

    /**
     * {@inheritdoc}
     */
    public function generate(): iterable
    {
        if (empty($this->routes)) {
            return $this->urls;
        }

        /** @var ChannelInterface $channel */
        $channel = $this->channelContext->getChannel();

        foreach ($this->routes as $route) {
            $staticUrl = $this->sitemapUrlFactory->createNew();
            $staticUrl->setChangeFrequency(ChangeFrequency::weekly());
            $staticUrl->setPriority(0.3);

            // Populate locales array by other enabled locales for current channel if no locales are specified
            if (!isset($route['locales']) || empty($route['locales'])) {
                $route['locales'] = $this->getAlternativeLocales($channel);
            }

            if (!array_key_exists('_locale', $route['parameters'])) {
                if ($channel->getDefaultLocale()) {
                    $route['parameters']['_locale'] = $channel->getDefaultLocale()->getCode();
                }
            }
            $location = $this->router->generate($route['route'], $route['parameters']);
            $staticUrl->setLocalization($location);

            foreach ($route['locales'] as $alternativeLocaleCode) {
                $route['parameters']['_locale'] = $alternativeLocaleCode;
                $alternativeLocation = $this->router->generate($route['route'], $route['parameters']);
                $staticUrl->addAlternative($alternativeLocation, $alternativeLocaleCode);
            }

            $this->urls[] = $staticUrl;
        }

        return $this->urls;
    }

    /**
     * @param ChannelInterface $channel
     *
     * @return string[]
     */
    private function getAlternativeLocales(ChannelInterface $channel): array
    {
        $locales = [];

        foreach ($channel->getLocales() as $locale) {
            if ($locale === $channel->getDefaultLocale()) {
                continue;
            }

            $locales[] = $locale->getCode();
        }

        return $locales;
    }

}
