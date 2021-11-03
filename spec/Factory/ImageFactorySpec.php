<?php

declare(strict_types=1);

namespace spec\StefanDoorn\SyliusSitemapPlugin\Factory;

use PhpSpec\ObjectBehavior;
use StefanDoorn\SyliusSitemapPlugin\Factory\ImageFactory;
use StefanDoorn\SyliusSitemapPlugin\Factory\ImageFactoryInterface;
use StefanDoorn\SyliusSitemapPlugin\Model\Image;

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
