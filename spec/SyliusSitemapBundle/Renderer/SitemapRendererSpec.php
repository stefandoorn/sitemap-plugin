<?php

namespace spec\SyliusSitemapBundle\Renderer;

use PhpSpec\ObjectBehavior;
use SyliusSitemapBundle\Model\SitemapInterface;
use SyliusSitemapBundle\Renderer\RendererAdapterInterface;
use SyliusSitemapBundle\Renderer\SitemapRenderer;
use SyliusSitemapBundle\Renderer\SitemapRendererInterface;

/**
 * @author Arkadiusz Krakowiak <arkadiusz.krakowiak@lakion.com>
 */
final class SitemapRendererSpec extends ObjectBehavior
{
    function let(RendererAdapterInterface $adapter)
    {
        $this->beConstructedWith($adapter);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(SitemapRenderer::class);
    }

    function it_implements_sitemap_renderer_interface()
    {
        $this->shouldImplement(SitemapRendererInterface::class);
    }

    function it_renders_sitemap($adapter, SitemapInterface $sitemap)
    {
        $adapter->render($sitemap)->shouldBeCalled();

        $this->render($sitemap);
    }
}
