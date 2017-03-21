<?php

namespace SyliusSitemapBundle\Renderer;

use SyliusSitemapBundle\Exception\TemplateNotFoundException;
use SyliusSitemapBundle\Model\SitemapInterface;
use Symfony\Component\Templating\EngineInterface;

/**
 * @author Arkadiusz Krakowiak <arkadiusz.krakowiak@lakion.com>
 */
final class TwigAdapter implements RendererAdapterInterface
{
    /**
     * @var EngineInterface
     */
    private $twig;

    /**
     * @var string
     */
    private $template;

    /**
     * @param EngineInterface $twig
     * @param string $template
     */
    public function __construct(EngineInterface $twig, $template)
    {
        $this->twig = $twig;
        $this->template = $template;
    }

    /**
     * {@inheritdoc}
     */
    public function render(SitemapInterface $sitemap)
    {
        return $this->twig->render($this->template, ['url_set' => $sitemap->getUrls()]);
    }
}
