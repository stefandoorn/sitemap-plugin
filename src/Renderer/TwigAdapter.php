<?php

declare(strict_types=1);

namespace SitemapPlugin\Renderer;

use SitemapPlugin\Model\SitemapInterface;
use Twig\Environment;

final class TwigAdapter implements RendererAdapterInterface
{
    /** @var Environment */
    private $twig;

    /** @var string */
    private $template;

    /** @var bool */
    private $hreflang;

    /** @var bool */
    private $images;

    public function __construct(Environment $twig, string $template, bool $hreflang = true, bool $images = true)
    {
        $this->twig = $twig;
        $this->template = $template;
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
            'hreflang' => $this->hreflang,
            'images' => $this->images,
        ]);
    }
}
