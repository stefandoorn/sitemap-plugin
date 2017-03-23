<?php

namespace SyliusSitemapBundle\Factory;

use SyliusSitemapBundle\Model\SitemapIndex;

/**
 * @author Stefan Doorn <stefan@efectos.nl>
 */
final class SitemapIndexFactory implements SitemapIndexFactoryInterface
{
    /**
     * {@inheritdoc}
     */
    public function createNew()
    {
        return new SitemapIndex();
    }
}
