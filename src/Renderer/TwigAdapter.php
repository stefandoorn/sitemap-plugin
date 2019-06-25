<?php

declare(strict_types=1);

namespace SitemapPlugin\Renderer;

use SitemapPlugin\Model\SitemapInterface;
use Symfony\Component\Templating\EngineInterface;

final class TwigAdapter implements RendererAdapterInterface
{
    /** @var EngineInterface */
    private $twig;

    /** @var string */
    private $template;

    /** @var bool */
    private $absoluteUrl;

    /** @var bool */
    private $hreflang;

    /** @var bool */
    private $images;

    public function __construct(EngineInterface $twig, string $template, bool $absoluteUrl, bool $hreflang = true, bool $images = true)
    {
        $this->twig = $twig;
        $this->template = $template;
        $this->absoluteUrl = $absoluteUrl;
        $this->hreflang = $hreflang;
        $this->images = $images;
    }

    /**
     * {@inheritdoc}
     */
    public function render(SitemapInterface $sitemap): string
    {
        return $this->twig->render($this->template, [
            'url_set' => $sitemap->getUrls(),
            'absolute_url' => $this->absoluteUrl,
            'hreflang' => $this->hreflang,
            'images' => $this->images,
        ]);
    }
}
