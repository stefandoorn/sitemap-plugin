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
        ChannelInterface $channel
    ): void {
        $sitemapFactory->createNew()->willReturn($sitemap);
        $this->addProvider($productUrlProvider);

        $productUrlProvider->generate($channel)->willReturn([$bookUrl]);
        $productUrlProvider->getName()->willReturn('products');

        $sitemap->setUrls([$bookUrl])->shouldBeCalled();

        $this->build('products', $channel)->shouldReturn($sitemap);
    }
}
