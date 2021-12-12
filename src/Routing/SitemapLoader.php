<?php

declare(strict_types=1);

namespace SitemapPlugin\Routing;

use SitemapPlugin\Builder\SitemapBuilderInterface;
use SitemapPlugin\Exception\RouteExistsException;
use Symfony\Component\Config\Loader\Loader;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;
use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;

final class SitemapLoader extends Loader implements ContainerAwareInterface
{
    use ContainerAwareTrait;

    private bool $loaded = false;

    private SitemapBuilderInterface $sitemapBuilder;

    public function __construct(SitemapBuilderInterface $sitemapBuilder)
    {
        parent::__construct();
        $this->sitemapBuilder = $sitemapBuilder;
    }

    public function load($resource, ?string $type = null)
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
                        '_controller' => 'sylius.controller.sitemap:showAction',
                        'name' => $provider->getName(),
                    ],
                    [],
                    [],
                    '',
                    [],
                    ['GET']
                )
            );
        }

        $this->loaded = true;

        return $routes;
    }

    public function supports($resource, string $type = null): bool
    {
        return 'sitemap' === $type;
    }
}
