<?php

declare(strict_types=1);

namespace spec\StefanDoorn\SyliusSitemapPlugin\Factory;

use PhpSpec\ObjectBehavior;
use StefanDoorn\SyliusSitemapPlugin\Factory\SitemapFactory;
use StefanDoorn\SyliusSitemapPlugin\Factory\SitemapFactoryInterface;
use StefanDoorn\SyliusSitemapPlugin\Model\Sitemap;

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
