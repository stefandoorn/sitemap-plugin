<?php

declare(strict_types=1);

namespace SitemapPlugin\Renderer;

use SitemapPlugin\Model\SitemapInterface;

final class SitemapRenderer implements SitemapRendererInterface
{
    /** @var RendererAdapterInterface */
    private $adapter;

    public function __construct(RendererAdapterInterface $adapter)
    {
        $this->adapter = $adapter;
    }

    /**
     * {@inheritdoc}
     */
    public function render(SitemapInterface $sitemap, ?int $limit = null): iterable
    {
        $urls = $sitemap->getUrls();
        $total = count($urls);

        if (null === $limit || $limit < 0) {
            $limit = $total;
        }

        foreach(array_chunk($urls, $limit) as $slice) {
            $sitemap->setUrls($slice);

            yield $this->adapter->render($sitemap);
        }
    }
}
