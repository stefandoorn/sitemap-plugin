<?php

declare(strict_types=1);

namespace SitemapPlugin\Renderer;

use SitemapPlugin\Model\SitemapInterface;

final class SitemapRenderer implements SitemapRendererInterface
{
    private RendererAdapterInterface $adapter;

    public function __construct(RendererAdapterInterface $adapter)
    {
        $this->adapter = $adapter;
    }

    public function render(SitemapInterface $sitemap): string
    {
        return $this->adapter->render($sitemap);
    }
}
