<?php

namespace spec\SitemapPlugin\Renderer;

use PhpSpec\ObjectBehavior;
use SitemapPlugin\Model\SitemapInterface;
use SitemapPlugin\Renderer\RendererAdapterInterface;
use SitemapPlugin\Renderer\SitemapRenderer;
use SitemapPlugin\Renderer\SitemapRendererInterface;

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
