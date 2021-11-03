<?php

declare(strict_types=1);

namespace StefanDoorn\SyliusSitemapPlugin\Renderer;

use StefanDoorn\SyliusSitemapPlugin\Model\SitemapInterface;

interface SitemapRendererInterface
{
    public function render(SitemapInterface $sitemap): string;
}
