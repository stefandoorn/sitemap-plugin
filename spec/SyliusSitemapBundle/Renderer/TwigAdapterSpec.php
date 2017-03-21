<?php

/*
 * This file is part of the Sylius package.
 *
 * (c) Paweł Jędrzejewski
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace spec\SyliusSitemapBundle\Renderer;

use PhpSpec\ObjectBehavior;
use SyliusSitemapBundle\Model\SitemapInterface;
use SyliusSitemapBundle\Model\SitemapUrlInterface;
use SyliusSitemapBundle\Renderer\RendererAdapterInterface;
use SyliusSitemapBundle\Renderer\TwigAdapter;
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
