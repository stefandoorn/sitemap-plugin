<?php

namespace SitemapPlugin\Factory;

use SitemapPlugin\Model\SitemapInterface;

/**
 * @author Arkadiusz Krakowiak <arkadiusz.krakowiak@lakion.com>
 */
interface SitemapFactoryInterface
{
    /**
     * @return SitemapInterface
     */
    public function createNew();
}
