<?php

namespace SyliusSitemapBundle\Renderer;

use SyliusSitemapBundle\Model\SitemapInterface;

/**
 * @author Arkadiusz Krakowiak <arkadiusz.krakowiak@lakion.com>
 */
final class SitemapRenderer implements SitemapRendererInterface
{
    /**
     * @var RendererAdapterInterface
     */
    private $adapter;

    /**
     * @param RendererAdapterInterface $adapter
     * @param array $configuration
     */
    public function __construct(RendererAdapterInterface $adapter, array $configuration = [])
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
