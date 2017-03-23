<?php

namespace SyliusSitemapBundle\Factory;

use SyliusSitemapBundle\Model\SitemapIndexUrlInterface;

/**
 * @author Stefan Doorn <stefan@efectos.nl>
 */
interface SitemapIndexUrlFactoryInterface
{
    /**
     * @return SitemapIndexUrlInterface
     */
    public function createNew();
}
