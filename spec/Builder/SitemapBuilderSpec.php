<?php

declare(strict_types=1);

namespace spec\SitemapPlugin\Builder;

use PhpSpec\ObjectBehavior;
use SitemapPlugin\Builder\SitemapBuilder;
use SitemapPlugin\Builder\SitemapBuilderInterface;
use SitemapPlugin\Factory\SitemapFactoryInterface;
use SitemapPlugin\Model\SitemapInterface;
use SitemapPlugin\Model\UrlInterface;
use SitemapPlugin\Provider\UrlProviderInterface;
use Sylius\Component\Core\Model\ChannelInterface;

final class SitemapBuilderSpec extends ObjectBehavior
{
    function let(SitemapFactoryInterface $sitemapFactory): void
    {
        $this->beConstructedWith($sitemapFactory);
    }

    function it_is_initializable(): void
    {
        $this->shouldHaveType(SitemapBuilder::class);
    }

    function it_implements_sitemap_builder_interface(): void
    {
        $this->shouldImplement(SitemapBuilderInterface::class);
    }

    function it_builds_sitemap(
        $sitemapFactory,
        UrlProviderInterface $productUrlProvider,
        SitemapInterface $sitemap,
        UrlInterface $bookUrl,
        ChannelInterface $channel,
    ): void {
        $sitemapFactory->createNew()->willReturn($sitemap);
        $this->addProvider($productUrlProvider);

        $productUrlProvider->generate($channel)->willReturn([$bookUrl]);

        $sitemap->setUrls([$bookUrl])->shouldBeCalled();

        $this->build($productUrlProvider, $channel)->shouldReturn($sitemap);
    }

    function it_builds_sitemap_with_generator(
        $sitemapFactory,
        UrlProviderInterface $productUrlProvider,
        SitemapInterface $sitemap,
        UrlInterface $bookUrl,
        ChannelInterface $channel
    ): void {
        $sitemapFactory->createNew()->willReturn($sitemap);

        $generator = new class($productUrlProvider->getWrappedObject()) implements UrlProviderInterface {
            private UrlProviderInterface $productUrlProvider;

            public function __construct(UrlProviderInterface $productUrlProvider)
            {
                $this->productUrlProvider = $productUrlProvider;
            }

            public function generate(ChannelInterface $channel): iterable
            {
                foreach ($this->productUrlProvider->generate($channel) as $url) {
                    yield $url;
                }
            }

            public function getName(): string
            {
                return 'product_iterable';
            }
        };

        $this->addProvider($generator);

        $productUrlProvider->generate($channel)->willReturn((function () use ($bookUrl) {
            yield $bookUrl;
        })());

        $sitemap->setUrls([$bookUrl])->shouldBeCalled();

        $this->build($productUrlProvider, $channel)->shouldReturn($sitemap);
    }
}
