<?php

declare(strict_types=1);

namespace Tests\SitemapPlugin\DependencyInjection\Compiler;

use Matthias\SymfonyDependencyInjectionTest\PhpUnit\AbstractExtensionTestCase;
use SitemapPlugin\DependencyInjection\SitemapExtension;

class SitemapParameterTest extends AbstractExtensionTestCase
{
    /**
     * @test
     * @dataProvider providers
     */
    public function it_has_providers_enabled_by_default_with_parameter(
        array $config,
        bool $products,
        bool $taxons,
        bool $static
    ) {
        $this->load($config);

        $this->assertContainerBuilderHasParameter(sprintf('sylius.provider.%s', 'products'), $products);
        $this->assertContainerBuilderHasParameter(sprintf('sylius.provider.%s', 'taxons'), $taxons);
        $this->assertContainerBuilderHasParameter(sprintf('sylius.provider.%s', 'static'), $static);

        if ($products) {
            $this->assertContainerBuilderHasService('sylius.sitemap_provider.product', \SitemapPlugin\Provider\ProductUrlProvider::class);
            $this->assertContainerBuilderHasServiceDefinitionWithTag('sylius.sitemap_provider.product', 'sylius.sitemap_provider');
        } else {
            $this->assertContainerBuilderNotHasService('sylius.sitemap_provider.product');
        }

        if ($taxons) {
            $this->assertContainerBuilderHasService('sylius.sitemap_provider.taxon', \SitemapPlugin\Provider\TaxonUrlProvider::class);
            $this->assertContainerBuilderHasServiceDefinitionWithTag('sylius.sitemap_provider.taxon', 'sylius.sitemap_provider');
        } else {
            $this->assertContainerBuilderNotHasService('sylius.sitemap_provider.taxon');
        }

        if ($static) {
            $this->assertContainerBuilderHasService('sylius.sitemap_provider.static', \SitemapPlugin\Provider\StaticUrlProvider::class);
            $this->assertContainerBuilderHasServiceDefinitionWithTag('sylius.sitemap_provider.static', 'sylius.sitemap_provider');
        } else {
            $this->assertContainerBuilderNotHasService('sylius.sitemap_provider.static');
        }
    }

    public function providers(): array
    {
        return [
            [
                ['providers' => [
                    'products' => true,
                    'taxons' => true,
                    'static' => true,
                ]],
                true,
                true,
                true,
            ],
            [
                ['providers' => []],
                true,
                true,
                true,
            ],
            [
                ['providers' => [
                    'products' => false,
                    'taxons' => false,
                    'static' => false,
                ]],
                false,
                false,
                false,
            ],
            [
                ['providers' => [
                    'products' => true,
                    'taxons' => false,
                    'static' => true,
                ]],
                true,
                false,
                true,
            ],
        ];
    }

    /**
     * @return array
     */
    protected function getContainerExtensions()
    {
        return [
            new SitemapExtension(),
        ];
    }
}
