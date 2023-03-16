<?php

declare(strict_types=1);

namespace SitemapPlugin\Routing;

use SitemapPlugin\Builder\SitemapBuilderInterface;
use SitemapPlugin\Exception\RouteExistsException;
use Symfony\Bundle\FrameworkBundle\Routing\RouteLoaderInterface;
use Symfony\Component\Config\Loader\Loader;
use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;

final class SitemapLoader extends Loader implements RouteLoaderInterface
{
    private bool $loaded = false;

    private SitemapBuilderInterface $sitemapBuilder;

    public function __construct(SitemapBuilderInterface $sitemapBuilder)
    {
        $this->sitemapBuilder = $sitemapBuilder;

        parent::__construct();
    }

    public function load($resource, $type = null)
    {
        $routes = new RouteCollection();

        if (true === $this->loaded) {
            return $routes;
        }

        foreach ($this->sitemapBuilder->getProviders() as $provider) {
            $name = 'sylius_sitemap_' . $provider->getName();

            if (null !== $routes->get($name)) {
                throw new RouteExistsException($name);
            }

            $routes->add(
                $name,
                new Route(
                    '/sitemap/' . $provider->getName() . '.xml',
                    [
                        '_controller' => 'sylius.controller.sitemap::showAction',
                        'name' => $provider->getName(),
                    ],
                    [],
                    [],
                    '',
                    [],
                    ['GET'],
                ),
            );
        }

        $this->loaded = true;

        return $routes;
    }

    public function supports($resource, $type = null): bool
    {
        return 'sitemap' === $type;
    }
}
