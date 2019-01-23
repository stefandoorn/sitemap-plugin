<?php

declare(strict_types=1);

namespace spec\SitemapPlugin\Factory;

use PhpSpec\ObjectBehavior;
use SitemapPlugin\Factory\SitemapUrlFactory;
use SitemapPlugin\Factory\SitemapUrlFactoryInterface;
use SitemapPlugin\Model\SitemapUrl;

final class SitemapUrlFactorySpec extends ObjectBehavior
{
    function it_is_initializable(): void
    {
        $this->shouldHaveType(SitemapUrlFactory::class);
    }

    function it_implements_sitemap_url_factory_interface(): void
    {
        $this->shouldImplement(SitemapUrlFactoryInterface::class);
    }

    function it_creates_empty_sitemap_url(): void
    {
        $this->createNew()->shouldBeLike(new SitemapUrl());
    }
}
