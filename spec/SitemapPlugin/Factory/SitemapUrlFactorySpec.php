<?php

declare(strict_types=1);

namespace spec\SitemapPlugin\Factory;

use PhpSpec\ObjectBehavior;
use SitemapPlugin\Factory\UrlFactory;
use SitemapPlugin\Factory\UrlFactoryInterface;
use SitemapPlugin\Model\Url;

final class SitemapUrlFactorySpec extends ObjectBehavior
{
    function it_is_initializable(): void
    {
        $this->shouldHaveType(UrlFactory::class);
    }

    function it_implements_sitemap_url_factory_interface(): void
    {
        $this->shouldImplement(UrlFactoryInterface::class);
    }

    function it_creates_empty_sitemap_url(): void
    {
        $this->createNew()->shouldBeLike(new Url());
    }
}
