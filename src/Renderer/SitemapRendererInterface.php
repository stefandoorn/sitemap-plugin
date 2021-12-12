<?php

declare(strict_types=1);

namespace SitemapPlugin\Renderer;

use SitemapPlugin\Model\SitemapInterface;

interface SitemapRendererInterface
{
    public function render(SitemapInterface $sitemap): string;
}
