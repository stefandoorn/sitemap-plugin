<?php

namespace spec\SitemapPlugin\Model;

use PhpSpec\ObjectBehavior;
use SitemapPlugin\Model\ChangeFrequency;
use SitemapPlugin\Model\SitemapUrl;
use SitemapPlugin\Model\SitemapUrlInterface;

/**
 * @author Arkadiusz Krakowiak <arkadiusz.krakowiak@lakion.com>
 * @author Stefan Doorn <stefan@efectos.nl>
 */
final class SitemapUrlSpec extends ObjectBehavior
{
    function it_is_initializable(): void
    {
        $this->shouldHaveType(SitemapUrl::class);
    }

    function it_implements_sitemap_url_interface(): void
    {
        $this->shouldImplement(SitemapUrlInterface::class);
    }

    function it_has_localization(): void
    {
        $this->setLocalization('http://sylius.org/');
        $this->getLocalization()->shouldReturn('http://sylius.org/');
    }

    function it_has_last_modification(\DateTime $now): void
    {
        $this->setLastModification($now);
        $this->getLastModification()->shouldReturn($now);
    }

    function it_has_change_frequency(): void
    {
        $this->setChangeFrequency(ChangeFrequency::always());
        $this->getChangeFrequency()->shouldReturn('always');
    }

    function it_has_priority(): void
    {
        $this->setPriority(0.5);
        $this->getPriority()->shouldReturn(0.5);
    }

    function it_throws_invalid_argument_exception_if_priority_wont_be_between_zero_and_one(): void
    {
        $this->shouldThrow(\InvalidArgumentException::class)->during('setPriority', array(-1));
        $this->shouldThrow(\InvalidArgumentException::class)->during('setPriority', array(-0.5));
        $this->shouldThrow(\InvalidArgumentException::class)->during('setPriority', array(2));
        $this->shouldThrow(\InvalidArgumentException::class)->during('setPriority', array(1.1));
    }
}
