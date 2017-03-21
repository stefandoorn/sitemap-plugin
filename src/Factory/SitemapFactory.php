<?php

namespace SyliusSitemapBundle\Factory;

use SyliusSitemapBundle\Model\Sitemap;

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
