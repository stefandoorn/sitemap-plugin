<?php

namespace spec\SitemapPlugin\Model;

use PhpSpec\ObjectBehavior;
use SitemapPlugin\Model\SitemapImageUrl;
use SitemapPlugin\Model\SitemapImageUrlInterface;

/**
 * @author Arkadiusz Krakowiak <arkadiusz.krakowiak@lakion.com>
 * @author Stefan Doorn <stefan@efectos.nl>
 */
final class SitemapImageUrlSpec extends ObjectBehavior
{
    function it_is_initializable(): void
    {
        $this->shouldHaveType(SitemapImageUrl::class);
    }

    function it_implements_sitemap_url_interface(): void
    {
        $this->shouldImplement(SitemapImageUrlInterface::class);
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
