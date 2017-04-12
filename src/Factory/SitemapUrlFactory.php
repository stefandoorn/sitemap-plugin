<?php

namespace SitemapPlugin\Factory;

use SitemapPlugin\Model\SitemapUrl;

/**
 * @author Arkadiusz Krakowiak <arkadiusz.krakowiak@lakion.com>
 */
final class SitemapUrlFactory implements SitemapUrlFactoryInterface
{
    /**
     * {@inheritdoc}
     */
    public function createNew()
    {
        return new SitemapUrl();
    }
}
