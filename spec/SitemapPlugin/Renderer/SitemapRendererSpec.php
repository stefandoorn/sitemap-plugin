<?php

namespace spec\SitemapPlugin\Renderer;

use PhpSpec\ObjectBehavior;
use SitemapPlugin\Model\SitemapInterface;
use SitemapPlugin\Renderer\RendererAdapterInterface;
use SitemapPlugin\Renderer\SitemapRenderer;
use SitemapPlugin\Renderer\SitemapRendererInterface;

/**
 * @author Arkadiusz Krakowiak <arkadiusz.krakowiak@lakion.com>
 * @author Stefan Doorn <stefan@efectos.nl>
 */
final class SitemapRendererSpec extends ObjectBehavior
{
    function let(RendererAdapterInterface $adapter): void
    {
        $this->beConstructedWith($adapter);
    }

    function it_is_initializable(): void
    {
        $this->shouldHaveType(SitemapRenderer::class);
    }

    function it_implements_sitemap_renderer_interface(): void
    {
        $this->shouldImplement(SitemapRendererInterface::class);
    }

    function it_renders_sitemap($adapter, SitemapInterface $sitemap): void
    {
        $adapter->render($sitemap)->shouldBeCalled();

        $this->render($sitemap);
    }
}
