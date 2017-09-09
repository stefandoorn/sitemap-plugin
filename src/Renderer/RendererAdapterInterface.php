<?php declare(strict_types=1);

namespace SitemapPlugin\Renderer;

use SitemapPlugin\Model\SitemapInterface;

/**
 * @author Arkadiusz Krakowiak <arkadiusz.krakowiak@lakion.com>
 * @author Stefan Doorn <stefan@efectos.nl>
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
    public function render(SitemapInterface $sitemap): string;
}
