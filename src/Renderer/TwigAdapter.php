<?php

namespace SitemapPlugin\Renderer;

use SitemapPlugin\Exception\TemplateNotFoundException;
use SitemapPlugin\Model\SitemapInterface;
use Symfony\Component\Templating\EngineInterface;

/**
 * @author Arkadiusz Krakowiak <arkadiusz.krakowiak@lakion.com>
 * @author Stefan Doorn <stefan@efectos.nl>
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
     * @var bool
     */
    private $absoluteUrl;

    /**
     * @param EngineInterface $twig
     * @param string $template
     */
    public function __construct(EngineInterface $twig, $template, $absoluteUrl)
    {
        $this->twig = $twig;
        $this->template = $template;
        $this->absoluteUrl = $absoluteUrl;
    }

    /**
     * {@inheritdoc}
     */
    public function render(SitemapInterface $sitemap)
    {
        return $this->twig->render($this->template, [
            'url_set' => $sitemap->getUrls(),
            'absolute_url' => $this->absoluteUrl,
        ]);
    }
}
