<?php

namespace spec\SyliusSitemapBundle\Model;

use PhpSpec\ObjectBehavior;
use SyliusSitemapBundle\Model\ChangeFrequency;

/**
 * @author Arkadiusz Krakowiak <arkadiusz.krakowiak@lakion.com>
 */
final class ChangeFrequencySpec extends ObjectBehavior
{
    function it_initialize_with_always_value()
    {
        $this->beConstructedThrough('always');
        $this->__toString()->shouldReturn('always');
    }

    function it_initialize_with_hourly_value()
    {
        $this->beConstructedThrough('hourly');
        $this->__toString()->shouldReturn('hourly');
    }

    function it_initialize_with_daily_value()
    {
        $this->beConstructedThrough('daily');
        $this->__toString()->shouldReturn('daily');
    }

    function it_initialize_with_weekly_value()
    {
        $this->beConstructedThrough('weekly');
        $this->__toString()->shouldReturn('weekly');
    }

    function it_initialize_with_monthly_value()
    {
        $this->beConstructedThrough('monthly');
        $this->__toString()->shouldReturn('monthly');
    }

    function it_initialize_with_yearly_value()
    {
        $this->beConstructedThrough('yearly');
        $this->__toString()->shouldReturn('yearly');
    }

    function it_initialize_with_never_value()
    {
        $this->beConstructedThrough('never');
        $this->__toString()->shouldReturn('never');
    }
}
