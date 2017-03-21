<?php

namespace spec\SyliusSitemapBundle\Factory;

use PhpSpec\ObjectBehavior;
use SyliusSitemapBundle\Factory\SitemapUrlFactory;
use SyliusSitemapBundle\Factory\SitemapUrlFactoryInterface;
use SyliusSitemapBundle\Model\SitemapUrl;
use SyliusSitemapBundle\Model\SitemapUrlInterface;

/**
 * @author Arkadiusz Krakowiak <arkadiusz.krakowiak@lakion.com>
 */
final class SitemapUrlFactorySpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(SitemapUrlFactory::class);
    }

    function it_implements_sitemap_url_factory_interface()
    {
        $this->shouldImplement(SitemapUrlFactoryInterface::class);
    }

    function it_creates_empty_sitemap_url()
    {
        $this->createNew()->shouldBeLike(new SitemapUrl());
    }
}
