<?php

declare(strict_types=1);

namespace spec\SitemapPlugin\Renderer;

use PhpSpec\ObjectBehavior;
use SitemapPlugin\Model\SitemapInterface;
use SitemapPlugin\Model\UrlInterface;
use SitemapPlugin\Renderer\RendererAdapterInterface;
use SitemapPlugin\Renderer\TwigAdapter;
use Symfony\Component\Templating\EngineInterface;
use Twig\Environment;

final class TwigAdapterSpec extends ObjectBehavior
{
    function let(EngineInterface $twig): void
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
