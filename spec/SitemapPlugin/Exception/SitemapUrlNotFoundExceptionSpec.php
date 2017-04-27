<?php

namespace spec\SitemapPlugin\Exception;

use PhpSpec\ObjectBehavior;
use SitemapPlugin\Exception\SitemapUrlNotFoundException;
use SitemapPlugin\Model\SitemapUrlInterface;

/**
 * @author Arkadiusz Krakowiak <arkadiusz.krakowiak@lakion.com>
 */
final class SitemapUrlNotFoundExceptionSpec extends ObjectBehavior
{
    function let(SitemapUrlInterface $sitemapUrl)
    {
        $sitemapUrl->getLocalization()->willReturn('http://sylius.org');
        $this->beConstructedWith($sitemapUrl, null);
    }

    function it_is_an_exception()
    {
        $this->shouldHaveType(\Exception::class);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(SitemapUrlNotFoundException::class);
    }
}
