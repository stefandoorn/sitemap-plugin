<?php

declare(strict_types=1);

namespace spec\SitemapPlugin\Builder\Model;

use PhpSpec\ObjectBehavior;

final class ChangeFrequencySpec extends ObjectBehavior
{
    function it_initialize_with_always_value(): void
    {
        $this->beConstructedThrough('always');
        $this->__toString()->shouldReturn('always');
    }

    function it_initialize_with_hourly_value(): void
    {
        $this->beConstructedThrough('hourly');
        $this->__toString()->shouldReturn('hourly');
    }

    function it_initialize_with_daily_value(): void
    {
        $this->beConstructedThrough('daily');
        $this->__toString()->shouldReturn('daily');
    }

    function it_initialize_with_weekly_value(): void
    {
        $this->beConstructedThrough('weekly');
        $this->__toString()->shouldReturn('weekly');
    }

    function it_initialize_with_monthly_value(): void
    {
        $this->beConstructedThrough('monthly');
        $this->__toString()->shouldReturn('monthly');
    }

    function it_initialize_with_yearly_value(): void
    {
        $this->beConstructedThrough('yearly');
        $this->__toString()->shouldReturn('yearly');
    }

    function it_initialize_with_never_value(): void
    {
        $this->beConstructedThrough('never');
        $this->__toString()->shouldReturn('never');
    }
}
