<?php

declare(strict_types=1);

namespace spec\SitemapPlugin\Factory;

use PhpSpec\ObjectBehavior;
use SitemapPlugin\Factory\ImageFactory;
use SitemapPlugin\Factory\ImageFactoryInterface;
use SitemapPlugin\Model\Image;

final class SitemapImageUrlFactorySpec extends ObjectBehavior
{
    function it_is_initializable(): void
    {
        $this->shouldHaveType(ImageFactory::class);
    }

    function it_implements_sitemap_url_factory_interface(): void
    {
        $this->shouldImplement(ImageFactoryInterface::class);
    }

    function it_creates_empty_sitemap_url(): void
    {
        $this->createNew()->shouldBeLike(new Image());
    }
}
