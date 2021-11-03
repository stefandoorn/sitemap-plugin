<?php

declare(strict_types=1);

namespace spec\StefanDoorn\SyliusSitemapPlugin\Factory;

use PhpSpec\ObjectBehavior;
use StefanDoorn\SyliusSitemapPlugin\Factory\UrlFactory;
use StefanDoorn\SyliusSitemapPlugin\Factory\UrlFactoryInterface;
use StefanDoorn\SyliusSitemapPlugin\Model\Url;

final class UrlFactorySpec extends ObjectBehavior
{
    function it_is_initializable(): void
    {
        $this->shouldHaveType(UrlFactory::class);
    }

    function it_implements_url_factory_interface(): void
    {
        $this->shouldImplement(UrlFactoryInterface::class);
    }

    function it_creates_empty_sitemap_url(): void
    {
        $this->createNew('location')->shouldBeLike(new Url('location'));
    }
}
