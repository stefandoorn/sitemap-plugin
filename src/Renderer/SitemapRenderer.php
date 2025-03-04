<?php

declare(strict_types=1);

namespace SitemapPlugin\Renderer;

use SitemapPlugin\Model\SitemapInterface;

final class SitemapRenderer implements SitemapRendererInterface
{
    public function __construct(private readonly RendererAdapterInterface $adapter)
    {
    }

    public function render(SitemapInterface $sitemap): string
    {
        return $this->adapter->render($sitemap);
    }
}
