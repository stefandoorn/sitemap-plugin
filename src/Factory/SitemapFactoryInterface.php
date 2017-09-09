<?php

namespace SitemapPlugin\Factory;

use SitemapPlugin\Model\SitemapInterface;

/**
 * @author Arkadiusz Krakowiak <arkadiusz.krakowiak@lakion.com>
 * @author Stefan Doorn <stefan@efectos.nl>
 */
interface SitemapFactoryInterface
{
    /**
     * @return SitemapInterface
     */
    public function createNew(): SitemapInterface;
}
