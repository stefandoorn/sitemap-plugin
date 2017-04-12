<?php

namespace SitemapPlugin\Factory;

use SitemapPlugin\Model\SitemapUrlInterface;

/**
 * @author Arkadiusz Krakowiak <arkadiusz.krakowiak@lakion.com>
 */
interface SitemapUrlFactoryInterface
{
    /**
     * @return SitemapUrlInterface
     */
    public function createNew();
}
