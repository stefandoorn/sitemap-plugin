<?php

declare(strict_types=1);

namespace SitemapPlugin\Renderer;

use SitemapPlugin\Model\SitemapInterface;

interface SitemapRendererInterface
{

    /**
     * @return string[]
     */
    public function render(SitemapInterface $sitemap, ?int $limit = null): iterable;
}
