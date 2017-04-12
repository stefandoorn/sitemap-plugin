<?php

namespace SitemapPlugin\Factory;

use SitemapPlugin\Model\Sitemap;

/**
 * @author Arkadiusz Krakowiak <arkadiusz.krakowiak@lakion.com>
 */
final class SitemapFactory implements SitemapFactoryInterface
{
    /**
     * {@inheritdoc}
     */
    public function createNew()
    {
        return new Sitemap();
    }
}
