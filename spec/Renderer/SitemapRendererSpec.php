<?php

declare(strict_types=1);

namespace spec\SitemapPlugin\Builder\Renderer;

use PhpSpec\ObjectBehavior;
use SitemapPlugin\Builder\Model\SitemapInterface;
use SitemapPlugin\Builder\Renderer\RendererAdapterInterface;
use SitemapPlugin\Builder\Renderer\SitemapRenderer;
use SitemapPlugin\Builder\Renderer\SitemapRendererInterface;

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
