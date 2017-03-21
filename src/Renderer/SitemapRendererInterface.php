<?php

namespace SyliusSitemapBundle\Renderer;

use SyliusSitemapBundle\Model\SitemapInterface;

/**
 * @author Arkadiusz Krakowiak <arkadiusz.krakowiak@lakion.com>
 */
interface SitemapRendererInterface
{
    /**
     * @param SitemapInterface $sitemap
     */
    public function render(SitemapInterface $sitemap);
}
