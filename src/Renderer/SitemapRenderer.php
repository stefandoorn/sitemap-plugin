<?php

namespace SitemapPlugin\Renderer;

use SitemapPlugin\Model\SitemapInterface;

/**
 * @author Arkadiusz Krakowiak <arkadiusz.krakowiak@lakion.com>
 * @author Stefan Doorn <stefan@efectos.nl>
 */
final class SitemapRenderer implements SitemapRendererInterface
{
    /**
     * @var RendererAdapterInterface
     */
    private $adapter;

    /**
     * @param RendererAdapterInterface $adapter
     */
    public function __construct(RendererAdapterInterface $adapter)
    {
        $this->adapter = $adapter;
    }

    /**
     * {@inheritdoc}
     */
    public function render(SitemapInterface $sitemap)
    {
        return $this->adapter->render($sitemap);
    }
}
