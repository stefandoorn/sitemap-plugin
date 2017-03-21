<?php

namespace SyliusSitemapBundle\Factory;

use SyliusSitemapBundle\Model\SitemapUrlInterface;

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
