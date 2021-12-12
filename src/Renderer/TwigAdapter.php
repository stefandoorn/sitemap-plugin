<?php

declare(strict_types=1);

namespace SitemapPlugin\Builder\Renderer;

use SitemapPlugin\Builder\Model\SitemapInterface;
use Twig\Environment;

final class TwigAdapter implements RendererAdapterInterface
{
    private Environment $twig;

    private string $template;

    private bool $hreflang;

    private bool $images;

    public function __construct(Environment $twig, string $template, bool $hreflang = true, bool $images = true)
    {
        $this->twig = $twig;
        $this->template = $template;
        $this->hreflang = $hreflang;
        $this->images = $images;
    }

    public function render(SitemapInterface $sitemap): string
    {
        return $this->twig->render($this->template, [
            'url_set' => $sitemap->getUrls(),
            'hreflang' => $this->hreflang,
            'images' => $this->images,
        ]);
    }
}
