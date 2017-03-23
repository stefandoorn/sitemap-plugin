<?php

namespace SyliusSitemapBundle\Factory;

use SyliusSitemapBundle\Model\SitemapIndexUrl;

/**
 * @author Stefan Doorn <stefan@efectos.nl>
 */
final class SitemapIndexUrlFactory implements SitemapIndexUrlFactoryInterface
{
    /**
     * {@inheritdoc}
     */
    public function createNew()
    {
        return new SitemapIndexUrl();
    }
}
