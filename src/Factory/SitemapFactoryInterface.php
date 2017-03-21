<?php

namespace SyliusSitemapBundle\Factory;

use SyliusSitemapBundle\Model\SitemapInterface;

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
