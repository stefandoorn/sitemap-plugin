<?php

declare(strict_types=1);

namespace spec\StefanDoorn\SyliusSitemapPlugin\Builder;

use PhpSpec\ObjectBehavior;
use StefanDoorn\SyliusSitemapPlugin\Builder\SitemapBuilder;
use StefanDoorn\SyliusSitemapPlugin\Builder\SitemapBuilderInterface;
use StefanDoorn\SyliusSitemapPlugin\Factory\SitemapFactoryInterface;
use StefanDoorn\SyliusSitemapPlugin\Model\SitemapInterface;
use StefanDoorn\SyliusSitemapPlugin\Model\UrlInterface;
use StefanDoorn\SyliusSitemapPlugin\Provider\UrlProviderInterface;
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

        $sitemap->setUrls([$bookUrl])->shouldBeCalled();

        $this->build($productUrlProvider, $channel)->shouldReturn($sitemap);
    }
}
