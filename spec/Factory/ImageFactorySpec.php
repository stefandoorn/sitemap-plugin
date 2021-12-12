<?php

declare(strict_types=1);

namespace spec\SitemapPlugin\Factory;

use PhpSpec\ObjectBehavior;
use SitemapPlugin\Factory\ImageFactory;
use SitemapPlugin\Factory\ImageFactoryInterface;
use SitemapPlugin\Model\Image;

final class ImageFactorySpec extends ObjectBehavior
{
    function it_is_initializable(): void
    {
        $this->shouldHaveType(ImageFactory::class);
    }

    function it_implements_image_factory_interface(): void
    {
        $this->shouldImplement(ImageFactoryInterface::class);
    }

    function it_creates_empty_sitemap_url(): void
    {
        $this->createNew('location')->shouldBeLike(new Image('location'));
    }
}
