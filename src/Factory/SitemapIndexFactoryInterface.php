<?php

namespace SyliusSitemapBundle\Factory;

use SyliusSitemapBundle\Model\SitemapIndexInterface;

/**
 * @author Stefan Doorn <stefan@efectos.nl>
 */
interface SitemapIndexFactoryInterface
{
    /**
     * @return SitemapIndexInterface
     */
    public function createNew();
}
