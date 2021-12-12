<?php

declare(strict_types=1);

namespace spec\SitemapPlugin\Builder\Model;

use PhpSpec\ObjectBehavior;
use SitemapPlugin\Builder\Model\AlternativeUrl;
use SitemapPlugin\Builder\Model\AlternativeUrlInterface;

final class AlternativeUrlSpec extends ObjectBehavior
{
    function let(): void
    {
        $this->beConstructedWith('location', 'locale');
    }

    function it_is_initializable(): void
    {
        $this->shouldHaveType(AlternativeUrl::class);
    }

    function it_implements_alternative_url_interface(): void
    {
        $this->shouldImplement(AlternativeUrlInterface::class);
    }

    function it_has_properties_set(): void
    {
        $this->getLocation()->shouldReturn('location');
        $this->getLocale()->shouldReturn('locale');
    }
}
