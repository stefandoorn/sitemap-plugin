<?php

declare(strict_types=1);

namespace SitemapPlugin\DependencyInjection;

use Symfony\Component\Config\Definition\ConfigurationInterface;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;

final class StefanDoornSyliusSitemapExtension extends Extension
{
    public function load(array $configs, ContainerBuilder $container): void
    {
        $config = $this->processConfiguration($this->getConfiguration([], $container), $configs);
        $loader = new XmlFileLoader($container, new FileLocator(__DIR__ . '/../Resources/config'));
        $loader->load('services.xml');

        $container->setParameter('sylius.sitemap_template', $config['template']);
        $container->setParameter('sylius.sitemap_index_template', $config['index_template']);
        $container->setParameter('sylius.sitemap_exclude_taxon_root', $config['exclude_taxon_root']);
        $container->setParameter('sylius.sitemap_hreflang', $config['hreflang']);
        $container->setParameter('sylius.sitemap_static', $config['static_routes']);
        $container->setParameter('sylius.sitemap_images', $config['images']);

        foreach ($config['providers'] as $provider => $setting) {
            $parameter = \sprintf('sylius.provider.%s', $provider);
            $container->setParameter($parameter, $setting);

            if ($setting === true) {
                $loader->load(\sprintf('services/providers/%s.xml', $provider));
            }
        }
    }

    public function getConfiguration(array $config, ContainerBuilder $container): ConfigurationInterface
    {
        return new Configuration();
    }
}
