<?php

declare(strict_types=1);

namespace SitemapPlugin\Builder\Renderer;

use SitemapPlugin\Builder\Model\SitemapInterface;

interface SitemapRendererInterface
{
    public function render(SitemapInterface $sitemap): string;
}
