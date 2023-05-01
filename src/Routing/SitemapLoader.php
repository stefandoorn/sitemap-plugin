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
    }
public function getCountryCodeByLocale(string $locale): string {
       return $locale == 'en_US'?'us': explode("_",$locale)[0];
    }
    private $channel;
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
            $url='/sitemap/' . $provider->getName() . '.xml';
            if(isset($provider->currentChannel)){
               $this->channel=$provider->currentChannel;
               $locale=$this->channel->getDefaultLocale()->getCode();
               $url='/'.$this->getCountryCodeByLocale($locale).'/'.$locale.'/sitemap/' . $provider->getName() . '.xml';
           }

            $routes->add(
                $name,
                new Route(
                    $url,
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

    public function supports($resource, $type = null): bool
    {
        return 'sitemap' === $type;
    }
}
