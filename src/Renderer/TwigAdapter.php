<?php

declare(strict_types=1);

namespace SitemapPlugin\Renderer;

use SitemapPlugin\Model\SitemapInterface;
use Twig\Environment;

final class TwigAdapter implements RendererAdapterInterface
{
    public function __construct(private readonly Environment $twig, private readonly string $template, private readonly bool $hreflang = true, private readonly bool $images = true)
    {
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
