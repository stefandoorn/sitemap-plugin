<?php

namespace SyliusSitemapBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

/**
 * @author Arkadiusz Krakowiak <arkadiusz.krakowiak@lakion.com>
 */
final class SitemapProviderPass implements CompilerPassInterface
{
    /**
     * {@inheritdoc}
     */
    public function process(ContainerBuilder $container)
    {
        if (!$container->has('sylius.sitemap_builder')) {
            return;
        }

        $builderDefinition = $container->findDefinition('sylius.sitemap_builder');
        $taggedProviders = $container->findTaggedServiceIds('sylius.sitemap_provider');

        foreach ($taggedProviders as $id => $tags) {
            $builderDefinition->addMethodCall('addProvider', [(new Reference($id))]);
        }
    }
}
