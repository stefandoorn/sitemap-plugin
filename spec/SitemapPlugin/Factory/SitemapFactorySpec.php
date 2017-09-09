<?php

namespace spec\SitemapPlugin\Factory;

use PhpSpec\ObjectBehavior;
use SitemapPlugin\Factory\SitemapFactory;
use SitemapPlugin\Factory\SitemapFactoryInterface;
use SitemapPlugin\Model\Sitemap;
use SitemapPlugin\Model\SitemapInterface;

/**
 * @author Arkadiusz Krakowiak <arkadiusz.krakowiak@lakion.com>
 * @author Stefan Doorn <stefan@efectos.nl>
 */
final class SitemapFactorySpec extends ObjectBehavior
{
    function it_is_initializable(): void
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
