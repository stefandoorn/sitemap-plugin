<?php

namespace spec\SyliusSitemapBundle\Factory;

use PhpSpec\ObjectBehavior;
use SyliusSitemapBundle\Factory\SitemapFactory;
use SyliusSitemapBundle\Factory\SitemapFactoryInterface;
use SyliusSitemapBundle\Model\Sitemap;
use SyliusSitemapBundle\Model\SitemapInterface;

/**
 * @author Arkadiusz Krakowiak <arkadiusz.krakowiak@lakion.com>
 */
final class SitemapFactorySpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(SitemapFactory::class);
    }

    function it_implements_sitemap_factory_interface()
    {
        $this->shouldImplement(SitemapFactoryInterface::class);
    }

    function it_creates_empty_sitemap()
    {
        $this->createNew()->shouldBeLike(new Sitemap());
    }
}
