<?php

declare(strict_types=1);

namespace spec\SitemapPlugin\Model;

use PhpSpec\ObjectBehavior;
use SitemapPlugin\Model\Image;
use SitemapPlugin\Model\ImageInterface;

final class SitemapImageUrlSpec extends ObjectBehavior
{
    function it_is_initializable(): void
    {
        $this->shouldHaveType(Image::class);
    }

    function it_implements_sitemap_url_interface(): void
    {
        $this->shouldImplement(ImageInterface::class);
    }

    function it_has_location(): void
    {
        $this->setLocation('http://sylius.org/');
        $this->getLocation()->shouldReturn('http://sylius.org/');
    }

    function it_has_title(): void
    {
        $this->setTitle('Super image');
        $this->getTitle()->shouldReturn('Super image');
    }

    function it_has_caption(): void
    {
        $this->setCaption('My caption');
        $this->getCaption()->shouldReturn('My caption');
    }

    function it_has_geo_location(): void
    {
        $this->setGeoLocation('France');
        $this->getGeoLocation()->shouldReturn('France');
    }

    function it_has_license(): void
    {
        $this->setLicense('No right reserved');
        $this->getLicense()->shouldReturn('No right reserved');
    }
}
