<?php

namespace SitemapPlugin\Factory;

use SitemapPlugin\Model\SitemapIndexUrl;

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
