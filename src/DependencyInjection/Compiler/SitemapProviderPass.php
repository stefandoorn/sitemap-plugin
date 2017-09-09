<?php declare(strict_types=1);

namespace SitemapPlugin\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

/**
 * @author Arkadiusz Krakowiak <arkadiusz.krakowiak@lakion.com>
 * @author Stefan Doorn <stefan@efectos.nl>
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
        $builderIndexDefinition = $container->findDefinition('sylius.sitemap_index_builder');
        $taggedProviders = $container->findTaggedServiceIds('sylius.sitemap_provider');

        foreach ($taggedProviders as $id => $tags) {
            $builderIndexDefinition->addMethodCall('addProvider', [(new Reference($id))]);
            $builderDefinition->addMethodCall('addProvider', [(new Reference($id))]);
        }

        $taggedProvidersIndex = $container->findTaggedServiceIds('sylius.sitemap_index_provider');
        foreach ($taggedProvidersIndex as $id => $tags) {
            $builderIndexDefinition->addMethodCall('addIndexProvider', [new Reference($id)]);
        }
    }
}
