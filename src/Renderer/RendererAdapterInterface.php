<?php

namespace SitemapPlugin\Renderer;

use SitemapPlugin\Model\SitemapInterface;

/**
 * @author Arkadiusz Krakowiak <arkadiusz.krakowiak@lakion.com>
 */
interface RendererAdapterInterface
{
    /**
     * @param SitemapInterface $sitemap
     *
     * @return string The evaluated template as a string
     *
     * @throws \RuntimeException if the template cannot be rendered
     */
    public function render(SitemapInterface $sitemap);
}
