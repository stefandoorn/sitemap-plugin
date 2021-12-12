<?php

declare(strict_types=1);

namespace spec\SitemapPlugin\Builder\Factory;

use PhpSpec\ObjectBehavior;
use SitemapPlugin\Builder\Factory\SitemapFactory;
use SitemapPlugin\Builder\Factory\SitemapFactoryInterface;
use SitemapPlugin\Builder\Model\Sitemap;

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
