<?php

namespace spec\SitemapPlugin\Builder;

use PhpSpec\ObjectBehavior;
use SitemapPlugin\Builder\SitemapBuilder;
use SitemapPlugin\Builder\SitemapBuilderInterface;
use SitemapPlugin\Factory\SitemapFactoryInterface;
use SitemapPlugin\Model\SitemapInterface;
use SitemapPlugin\Model\SitemapUrlInterface;
use SitemapPlugin\Provider\UrlProviderInterface;

/**
 * @author Arkadiusz Krakowiak <arkadiusz.krakowiak@lakion.com>
 * @author Stefan Doorn <stefan@efectos.nl>
 */
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
        UrlProviderInterface $staticUrlProvider,
        SitemapInterface $sitemap,
        SitemapUrlInterface $bookUrl,
        SitemapUrlInterface $homePage
    ): void {
        $sitemapFactory->createNew()->willReturn($sitemap);
        $this->addProvider($productUrlProvider);
        $this->addProvider($staticUrlProvider);
        $productUrlProvider->generate()->willReturn([$bookUrl]);
        $staticUrlProvider->generate()->willReturn([$homePage]);

        $sitemap->setUrls([$bookUrl, $homePage])->shouldBeCalled();

        $this->build()->shouldReturn($sitemap);
    }
}
