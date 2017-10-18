<?php

namespace Tests\SitemapPlugin\DependencyInjection\Compiler;

use Matthias\SymfonyDependencyInjectionTest\PhpUnit\AbstractCompilerPassTestCase;
use Matthias\SymfonyDependencyInjectionTest\PhpUnit\DefinitionHasMethodCallConstraint;
use SitemapPlugin\Builder\SitemapIndexBuilder;
use SitemapPlugin\DependencyInjection\Compiler\SitemapProviderPass;
use SitemapPlugin\Builder\SitemapBuilder;
use SitemapPlugin\Provider\IndexUrlProvider;
use SitemapPlugin\Provider\ProductUrlProvider;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\Reference;

/**
 * @author Arkadiusz Krakowiak <arkadiusz.krakowiak@lakion.com>
 * @author Stefan Doorn <stefan@efectos.nl>
 */
class SitemapProviderPassTest extends AbstractCompilerPassTestCase
{
    /**
     * @test
     */
    public function it_adds_method_call_to_sitemap_builder_if_providers_exist()
    {
        $sitemapBuilderDefinition = new Definition(SitemapBuilder::class);
        $this->setDefinition('sylius.sitemap_builder', $sitemapBuilderDefinition);

        $productUrlProviderDefinition = new Definition(ProductUrlProvider::class);
        $productUrlProviderDefinition->addTag('sylius.sitemap_provider');
        $this->setDefinition('sylius.sitemap_provider.product', $productUrlProviderDefinition);

        $sitemapBuilderDefinition = new Definition(SitemapIndexBuilder::class);
        $this->setDefinition('sylius.sitemap_index_builder', $sitemapBuilderDefinition);

        $indexUrlProviderDefinition = new Definition(IndexUrlProvider::class);
        $indexUrlProviderDefinition->addTag('sylius.sitemap_index_provider');
        $this->setDefinition('sylius.sitemap_index_provider.index', $indexUrlProviderDefinition);

        $this->compile();

        $this->assertContainerBuilderHasServiceDefinitionWithMethodCall(
            'sylius.sitemap_builder',
            'addProvider',
            [
                new Reference('sylius.sitemap_provider.product'),
            ]
        );

        $this->assertContainerBuilderHasServiceDefinitionWithMethodCall(
            'sylius.sitemap_index_builder',
            'addIndexProvider',
            [
                new Reference('sylius.sitemap_index_provider.index'),
            ]
        );
    }

    /**
     * @test
     */
    public function it_does_not_add_method_call_if_there_is_no_url_providers()
    {
        $sitemapBuilderDefinition = new Definition(SitemapBuilder::class);
        $this->setDefinition('sylius.sitemap_builder', $sitemapBuilderDefinition);

        $sitemapBuilderDefinition = new Definition(SitemapIndexBuilder::class);
        $this->setDefinition('sylius.sitemap_index_builder', $sitemapBuilderDefinition);

        $this->compile();

        $this->assertContainerBuilderDoesNotHaveServiceDefinitionWithMethodCall(
            'sylius.sitemap_builder',
            'addProvider'
        );

        $this->assertContainerBuilderDoesNotHaveServiceDefinitionWithMethodCall(
            'sylius.sitemap_index_builder',
            'addProvider'
        );
    }

    /**
     * {@inheritdoc}
     */
    protected function registerCompilerPass(ContainerBuilder $container)
    {
        $container->addCompilerPass(new SitemapProviderPass());
    }

    /**
     * @param string $serviceId
     * @param string $method
     */
    private function assertContainerBuilderDoesNotHaveServiceDefinitionWithMethodCall($serviceId, $method)
    {
        $definition = $this->container->findDefinition($serviceId);

        self::assertThat(
            $definition,
            new \PHPUnit_Framework_Constraint_Not(new DefinitionHasMethodCallConstraint($method))
        );
    }

    /**
     * @return array
     */
    public function providers(): array
    {
        return [
            ['products'],
            ['taxons'],
            ['static'],
        ];
    }
}
