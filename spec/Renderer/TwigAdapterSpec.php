<?php

declare(strict_types=1);

namespace spec\StefanDoorn\SyliusSitemapPlugin\Renderer;

use PhpSpec\ObjectBehavior;
use StefanDoorn\SyliusSitemapPlugin\Model\SitemapInterface;
use StefanDoorn\SyliusSitemapPlugin\Model\UrlInterface;
use StefanDoorn\SyliusSitemapPlugin\Renderer\RendererAdapterInterface;
use StefanDoorn\SyliusSitemapPlugin\Renderer\TwigAdapter;
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
