<?php

declare(strict_types=1);

namespace spec\SitemapPlugin\Exception;

use PhpSpec\ObjectBehavior;
use SitemapPlugin\Exception\SitemapUrlNotFoundException;
use SitemapPlugin\Model\SitemapUrlInterface;

final class SitemapUrlNotFoundExceptionSpec extends ObjectBehavior
{
    function let(SitemapUrlInterface $sitemapUrl): void
    {
        $sitemapUrl->getLocalization()->willReturn('http://sylius.org');
        $this->beConstructedWith($sitemapUrl, null);
    }

    function it_is_an_exception(): void
    {
        $this->shouldHaveType(\Exception::class);
    }

    function it_is_initializable(): void
    {
        $this->shouldHaveType(SitemapUrlNotFoundException::class);
    }
}
