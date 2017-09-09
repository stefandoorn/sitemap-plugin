<?php

namespace SitemapPlugin\Renderer;

use SitemapPlugin\Model\SitemapInterface;

/**
 * @author Arkadiusz Krakowiak <arkadiusz.krakowiak@lakion.com>
 * @author Stefan Doorn <stefan@efectos.nl>
 */
interface SitemapRendererInterface
{
    /**
     * @param SitemapInterface $sitemap
     */
    public function render(SitemapInterface $sitemap): string;
}
