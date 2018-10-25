<?php

namespace spec\SitemapPlugin\Factory;

use PhpSpec\ObjectBehavior;
use SitemapPlugin\Factory\SitemapImageUrlFactory;
use SitemapPlugin\Factory\SitemapImageUrlFactoryInterface;
use SitemapPlugin\Model\SitemapImageUrl;

/**
 * @author Arkadiusz Krakowiak <arkadiusz.krakowiak@lakion.com>
 * @author Stefan Doorn <stefan@efectos.nl>
 */
final class SitemapImageUrlFactorySpec extends ObjectBehavior
{
    function it_is_initializable(): void
    {
        $this->shouldHaveType(SitemapImageUrlFactory::class);
    }

    function it_implements_sitemap_url_factory_interface(): void
    {
        $this->shouldImplement(SitemapImageUrlFactoryInterface::class);
    }

    function it_creates_empty_sitemap_url(): void
    {
        $this->createNew()->shouldBeLike(new SitemapImageUrl());
    }
}
