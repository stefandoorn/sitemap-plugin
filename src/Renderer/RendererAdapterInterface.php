<?php

declare(strict_types=1);

namespace SitemapPlugin\Renderer;

use SitemapPlugin\Model\SitemapInterface;

interface RendererAdapterInterface
{
    /**
     * @return string The evaluated template as a string
     *
     * @throws \RuntimeException if the template cannot be rendered
     */
    public function render(SitemapInterface $sitemap): string;
}
