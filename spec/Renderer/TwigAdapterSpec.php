<?php

declare(strict_types=1);

namespace spec\SitemapPlugin\Builder\Renderer;

use PhpSpec\ObjectBehavior;
use SitemapPlugin\Builder\Model\SitemapInterface;
use SitemapPlugin\Builder\Model\UrlInterface;
use SitemapPlugin\Builder\Renderer\RendererAdapterInterface;
use SitemapPlugin\Builder\Renderer\TwigAdapter;
use Twig\Environment;

final class TwigAdapterSpec extends ObjectBehavior
{
    function let(Environment $twig): void
    {
        $this->beConstructedWith($twig, '@SyliusCore/Sitemap/url_set.xml.twig', true);
    }

    function it_is_initializable(): void
    {
        $this->shouldHaveType(TwigAdapter::class);
    }

    function it_implements_renderer_adapter_interface(): void
    {
        $this->shouldImplement(RendererAdapterInterface::class);
    }

    function it_renders_sitemap(Environment $twig, SitemapInterface $sitemap, UrlInterface $productUrl): void
    {
        $sitemap->getUrls()->willReturn([$productUrl]);

        $twig->render('@SyliusCore/Sitemap/url_set.xml.twig', [
            'url_set' => [$productUrl],
            'hreflang' => true,
            'images' => true,
        ])->shouldBeCalled()->willReturn('');

        $this->render($sitemap);
    }
}
