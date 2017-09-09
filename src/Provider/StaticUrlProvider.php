<?php declare(strict_types=1);

namespace SitemapPlugin\Provider;

use SitemapPlugin\Factory\SitemapUrlFactoryInterface;
use SitemapPlugin\Model\ChangeFrequency;
use Sylius\Component\Locale\Context\LocaleContextInterface;
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
     * @var LocaleContextInterface
     */
    private $localeContext;

    /**
     * @var array
     */
    private $urls = [];

    /**
     * @var array
     */
    private $routes;

    /**
     * StaticUrlProvider constructor.
     * @param RouterInterface $router
     * @param SitemapUrlFactoryInterface $sitemapUrlFactory
     * @param LocaleContextInterface $localeContext
     * @param array $routes
     */
    public function __construct(
        RouterInterface $router,
        SitemapUrlFactoryInterface $sitemapUrlFactory,
        LocaleContextInterface $localeContext,
        array $routes
    ) {
        $this->router = $router;
        $this->sitemapUrlFactory = $sitemapUrlFactory;
        $this->localeContext = $localeContext;
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

        foreach ($this->routes as $route) {
            $staticUrl = $this->sitemapUrlFactory->createNew();
            $staticUrl->setChangeFrequency(ChangeFrequency::weekly());
            $staticUrl->setPriority(0.3);

            if (!isset($route['locales']) || empty($route['locales'])) {
                $route['locales'] = [$this->localeContext->getLocaleCode()];
            }

            foreach ($route['locales'] as $localeCode) {
                // Add localeCode to parameters if not set
                if (!array_key_exists('_locale', $route['parameters'])) {
                    $route['parameters']['_locale'] = $localeCode;
                }

                $location = $this->router->generate($route['route'], $route['parameters']);

                if ($localeCode === $this->localeContext->getLocaleCode()) {
                    $staticUrl->setLocalization($location);
                } else {
                    $staticUrl->addAlternative($location, $localeCode);
                }

                $this->urls[] = $staticUrl;
            }
        }

        return $this->urls;
    }
}
