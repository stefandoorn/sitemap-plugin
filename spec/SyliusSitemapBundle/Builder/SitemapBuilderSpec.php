<?php

/*
 * This file is part of the Sylius package.
 *
 * (c) Paweł Jędrzejewski
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace spec\SyliusSitemapBundle\Builder;

use PhpSpec\ObjectBehavior;
use SyliusSitemapBundle\Builder\SitemapBuilder;
use SyliusSitemapBundle\Builder\SitemapBuilderInterface;
use SyliusSitemapBundle\Factory\SitemapFactoryInterface;
use SyliusSitemapBundle\Model\SitemapInterface;
use SyliusSitemapBundle\Model\SitemapUrlInterface;
use SyliusSitemapBundle\Provider\UrlProviderInterface;

/**
 * @author Arkadiusz Krakowiak <arkadiusz.krakowiak@lakion.com>
 */
final class SitemapBuilderSpec extends ObjectBehavior
{
    function let(SitemapFactoryInterface $sitemapFactory)
    {
        $this->beConstructedWith($sitemapFactory);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(SitemapBuilder::class);
    }

    function it_implements_sitemap_builder_interface()
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
    ) {
        $sitemapFactory->createNew()->willReturn($sitemap);
        $this->addProvider($productUrlProvider);
        $this->addProvider($staticUrlProvider);
        $productUrlProvider->generate()->willReturn([$bookUrl]);
        $staticUrlProvider->generate()->willReturn([$homePage]);

        $sitemap->setUrls([$bookUrl, $homePage])->shouldBeCalled();

        $this->build()->shouldReturn($sitemap);
    }
}
