<?php

namespace spec\SitemapPlugin\Renderer;

use PhpSpec\ObjectBehavior;
use SitemapPlugin\Model\SitemapInterface;
use SitemapPlugin\Model\SitemapUrlInterface;
use SitemapPlugin\Renderer\RendererAdapterInterface;
use SitemapPlugin\Renderer\TwigAdapter;
use Symfony\Component\Templating\EngineInterface;

/**
 * @author Arkadiusz Krakowiak <arkadiusz.krakowiak@lakion.com>
 */
final class TwigAdapterSpec extends ObjectBehavior
{
    function let(EngineInterface $twig)
    {
        $this->beConstructedWith($twig, '@SyliusCore/Sitemap/url_set.xml.twig');
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(TwigAdapter::class);
    }

    function it_implements_renderer_adapter_interface()
    {
        $this->shouldImplement(RendererAdapterInterface::class);
    }

    function it_renders_sitemap($twig, SitemapInterface $sitemap, SitemapUrlInterface $productUrl)
    {
        $sitemap->getUrls()->willReturn([$productUrl]);
        $twig->render('@SyliusCore/Sitemap/url_set.xml.twig', ['url_set' => [$productUrl]])->shouldBeCalled();

        $this->render($sitemap);
    }
}
