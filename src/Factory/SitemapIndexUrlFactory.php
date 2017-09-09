<?php declare(strict_types=1);

namespace SitemapPlugin\Factory;

use SitemapPlugin\Model\SitemapIndexUrl;
use SitemapPlugin\Model\SitemapIndexUrlInterface;

/**
 * @author Stefan Doorn <stefan@efectos.nl>
 */
final class SitemapIndexUrlFactory implements SitemapIndexUrlFactoryInterface
{
    /**
     * {@inheritdoc}
     */
    public function createNew(): SitemapIndexUrlInterface
    {
        return new SitemapIndexUrl();
    }
}
