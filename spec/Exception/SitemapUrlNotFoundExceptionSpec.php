<?php

declare(strict_types=1);

namespace spec\SitemapPlugin\Exception;

use PhpSpec\ObjectBehavior;
use SitemapPlugin\Exception\SitemapUrlNotFoundException;
use SitemapPlugin\Model\UrlInterface;

final class SitemapUrlNotFoundExceptionSpec extends ObjectBehavior
{
    function let(UrlInterface $url): void
    {
        $url->getLocation()->willReturn('http://sylius.org');
        $this->beConstructedWith($url, null);
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
