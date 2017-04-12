<?php

namespace SitemapPlugin\Factory;

use SitemapPlugin\Model\SitemapIndex;

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
