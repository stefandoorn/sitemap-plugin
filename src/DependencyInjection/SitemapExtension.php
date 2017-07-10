<?php

namespace SitemapPlugin\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;

/**
 * @author Stefan Doorn <stefan@efectos.nl>
 */
final class SitemapExtension extends Extension
{
    /**
     * {@inheritdoc}
     */
    public function load(array $config, ContainerBuilder $container)
    {
        $config = $this->processConfiguration($this->getConfiguration([], $container), $config);
        $loader = new XmlFileLoader($container, new FileLocator(__DIR__ . '/../Resources/config'));

        $loader->load('services.xml');

        $container->setParameter('sylius.sitemap_template', $config['template']);
        $container->setParameter('sylius.sitemap_index_template', $config['index_template']);
        $container->setParameter('sylius.sitemap_exclude_taxon_root', $config['exclude_taxon_root']);
        $container->setParameter('sylius.sitemap_absolute_url', $config['absolute_url']);
        $container->setParameter('sylius.sitemap_hreflang', $config['hreflang']);
    }
}
