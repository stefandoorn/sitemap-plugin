<?php

namespace SyliusSitemapBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * @author Stefan Doorn <stefan@efectos.nl>
 */
final class Configuration implements ConfigurationInterface
{
    /**
     * @return TreeBuilder
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('sylius_sitemap');

        $this->addSitemapSection($rootNode);

        return $treeBuilder;
    }

    /**
     * @param ArrayNodeDefinition $node
     */
    private function addSitemapSection(ArrayNodeDefinition $node)
    {
        $node
            ->children()
            ->scalarNode('template')->defaultValue('@SyliusSitemap/show.xml.twig')->end()
            ->end();
    }
}
